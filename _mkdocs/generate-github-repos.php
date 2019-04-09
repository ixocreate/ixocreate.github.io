<?php
final class Generate
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_USERAGENT, "PHP");
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 4);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 2);
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }

    public function generate()
    {
        $pages = $this->getPages();

        $items = [];

        for ($i = 1; $i <= $pages; $i++) {
            $result = $this->fetch($i);
            $result = json_decode($result, true);
            $items = array_merge($items, $result);
        }

        $repos = [];
        foreach ($items as $item) {
            if (in_array($item['name'], ['admin-frontend', 'coding-standard', 'ixocreate', 'ixocreate.github.io'])) {
                continue;
            }

            $repos[] = [
                'fullName' => $item['full_name'],
                'url' => $item['html_url'],
                'description' => $item['description'],
            ];
        }

        $html = [];
        foreach ($repos as $repo) {
            $html[] = '<div class="row mt-3">';
            $html[] = '<div class="col-md-12 col-lg-3"><a href="' . $repo['url'] . '" target="_blank">' . $repo['fullName'] . '</a></div>';
            $html[] = '<div class="col-md-12 col-lg-9">';
            $html[] = '<div class="row">';
            $html[] = '<div class="col-md-12 col-lg-2"><a href="' . sprintf('https://travis-ci.com/%s/branches', $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/travis/%s.svg', $repo['fullName']) . '"></a></div>';
            $html[] = '<div class="col-md-12 col-lg-2"><a href="' . sprintf('https://coveralls.io/github/%s?branch=master', $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/coveralls/github/%s.svg', $repo['fullName']) . '"></a></div>';
            $html[] = '<div class="col-md-12 col-lg-2"><a href="' . sprintf('https://packagist.org/packages/%s', $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/packagist/v/%s.svg', $repo['fullName']) . '"></a></div>';
            $html[] = '<div class="col-md-12 col-lg-2"><a href="' . sprintf('https://github.com/%s/blob/master/LICENSE', $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/github/license/%s.svg', $repo['fullName']) . '"></a></div>';
            $html[] = '<div class="col-md-12 col-lg-2"><a href="' . sprintf('https://github.com/%s/issues', $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/github/issues/%s.svg', $repo['fullName']) . '"></a></div>';
            $html[] = '<div class="col-md-12 col-lg-2"><a href="' . $repo['url'] . '" target="_blank"><img src="' . sprintf('https://img.shields.io/github/commit-activity/m/%s.svg', $repo['fullName']) . '"></a></div>';
            $html[] = '</div>';
            $html[] = '</div>';
            $html[] = '</div>';
            if (!empty($repo['description'])) {
                $html[] = '<div>' . $repo['description'] . '</div>';
            }
        }

        file_put_contents(__DIR__ . '/ixocreate_theme/repos.html', implode($html, PHP_EOL));
    }

    public function getPages(): int
    {
        $page = 1;

        $url = "https://api.github.com/orgs/ixocreate/repos?page=1&type=all&sort=full_name";
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HEADER, true);
        curl_setopt($this->curl, CURLOPT_NOBODY, true);

        $result = curl_exec($this->curl);

        $lines = explode("\r\n", $result);

        foreach ($lines as $line) {
            $line = trim($line);
            if (substr($line, 0, 6) !== "Link: ") {
                continue;
            }

            $links = explode(', ', trim(substr($line, 6)));
            foreach ($links as $link) {
                $hrefandrel = explode('; ', $link);
                if (count($hrefandrel) !== 2 || empty($hrefandrel[1])) {
                    continue;
                }

                if ($hrefandrel[1] !== 'rel="last"') {
                    continue;
                }

                $href = trim($hrefandrel[0], '<>');
                $query = parse_url($href, PHP_URL_QUERY);
                if (empty($query)) {
                    break 2;
                }

                $queryParams = [];
                parse_str($query, $queryParams);

                if (empty($queryParams['page'])) {
                    break 2;
                }

                $page = (int) $queryParams['page'];
                break 2;
            }
        }

        return $page;
    }

    public function fetch(int $page = 1)
    {
        $url = "https://api.github.com/orgs/ixocreate/repos?page=".$page."&type=all&sort=full_name";
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HEADER, false);
        curl_setopt($this->curl, CURLOPT_NOBODY, false);
        curl_setopt($this->curl, CURLOPT_HTTPGET, true);

        return trim(curl_exec($this->curl));

    }
}

(new Generate())->generate();


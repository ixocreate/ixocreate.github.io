<?php

final class GithubReposPageGenerator
{
    private $curl;

    private $orderPriority = [
        'ixocreate',
        'coding-standard',
        'admin-frontend',
    ];

    private $noBuild = [
        'ixocreate',
        'coding-standard',
        'admin-frontend',
    ];

    private $noTests = [
        'ixocreate',
        'coding-standard',
        'admin-frontend',
        'test',
    ];

    private $exclude = [
        'ixocreate.github.io',
        'express-package',
        'log',
        'log-package',
        'security-header',
        'template-package',
    ];

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

    public function generate(string $org, string $output)
    {
        file_put_contents(__DIR__ . '/' . $output, $this->render($this->repos($org)));
    }

    public function repos(string $org): array
    {
        $page = 1;
        $force = false;
        $repos = [];

        while ($page > 0) {
            $response = $this->request($org, $page, $force);
            $repos = array_merge($repos, $response['data']);
            $page = $this->nextPageNumber($response['headers']['link'][0]);
        }

        $repos = array_map(function ($repo) {
            return [
                'name' => $repo['name'],
                'fullName' => $repo['full_name'],
                'url' => $repo['html_url'],
                'description' => $repo['description'],
                'language' => $repo['language'],
                'archived' => $repo['archived'],
            ];
        }, $repos);

        $repos = array_filter($repos, function ($repo) {
            return !$repo['archived'] && !in_array($repo['name'], $this->exclude);
        });

        uasort($repos, function ($a, $b) {
            $aName = strtolower($a['name']);
            $bName = strtolower($b['name']);
            if (in_array($aName, $this->orderPriority) && in_array($bName, $this->orderPriority)) {
                return (array_search($aName, $this->orderPriority) > array_search($bName,
                        $this->orderPriority)) ? 1 : -1;
            }
            if (in_array($aName, $this->orderPriority)) {
                return -1;
            }
            if (in_array($bName, $this->orderPriority)) {
                return 1;
            }
            return strcmp($aName, $bName);
        });

        return $repos;
    }

    public function request(string $org, int $page = 1, $force = false): array
    {
        return json_decode($this->fetch($org, $page, $force), true);
    }

    public function fetch(string $org, int $page = 1, $force = false): string
    {
        $cacheFile = "$org-$page.json";
        if (!$force && file_exists($cacheFile) && time() - filemtime($cacheFile) < 600) {
            return file_get_contents($cacheFile);
        }

        $url = 'https://api.github.com/orgs/' . $org . '/repos?page=' . $page . '&type=all&sort=full_name';

        $headers = [];
        curl_setopt($this->curl, CURLOPT_URL, $url);

        // this function is called by curl for each header received
        curl_setopt($this->curl, CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) // ignore invalid headers
                {
                    return $len;
                }
                $name = strtolower(trim($header[0]));
                if (!array_key_exists($name, $headers)) {
                    $headers[$name] = [trim($header[1])];
                } else {
                    $headers[$name][] = trim($header[1]);
                }
                return $len;
            }
        );

        $data = json_decode(trim(curl_exec($this->curl)), true);

        $response = json_encode([
            'headers' => $headers,
            'data' => $data,
        ]);

        file_put_contents($cacheFile, $response);

        return $response;
    }

    private function nextPageNumber($linksHeader)
    {
        $page = null;
        $links = explode(', ', trim(substr($linksHeader, 6)));
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
                break;
            }

            $queryParams = [];
            parse_str($query, $queryParams);

            if (empty($queryParams['page'])) {
                break;
            }

            $page = (int)$queryParams['page'];
            break;
        }
        return $page;
    }

    private function render(array $repos): string
    {
        $html = [];
        foreach ($repos as $repo) {
            $html[] = '<div class="row mt-3">';
            $html[] = '<div class="col-lg-5 col-xl-3">';
            $html[] = '<h5 class="mb-0">' . $repo['description'] . '</h5>';
            $html[] = '<a href="' . $repo['url'] . '" target="_blank" title="' . $repo['description'] . '"><i class="fab fa-sm fa-fw fa-github"></i> <b>' . $repo['fullName'] . '</b></a>';
            $html[] = '</div>';
            $html[] = '<div class="col-lg-7 col-xl-9">';
            $html[] = '<div class="row">';

            $html[] = '<div class="col-xl"><a href="' . sprintf('https://packagist.org/packages/%s',
                    $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/packagist/v/%s.svg',
                    $repo['fullName']) . '" alt="Packagist"></a></div>';

            if (!$repo['language'] || $repo['language'] === 'PHP') {
                $html[] = '<div class="col-xl"><a href="' . sprintf('https://packagist.org/packages/%s',
                        $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/packagist/php-v/%s.svg',
                        $repo['fullName']) . '" alt="PHP Version"></a></div>';
            } else {
                $html[] = '<div class="col-xl"></div>';
            }

            $html[] = '<div class="col-xl"><a href="' . sprintf('https://github.com/%s/blob/master/LICENSE',
                    $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/github/license/%s.svg',
                    $repo['fullName']) . '" alt="LICENSE"></a></div>';

            $html[] = '<div class="col-xl"><a href="' . sprintf('https://github.com/%s/issues',
                    $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://img.shields.io/github/issues/%s.svg',
                    $repo['fullName']) . '" alt="Open Issues"></a></div>';

            // $html[] = '<div class="col-xl"><a href="' . $repo['url'] . '" target="_blank"><img src="' . sprintf('https://img.shields.io/github/commit-activity/m/%s.svg', $repo['fullName']) . '"></a></div>';

            if (!in_array($repo['name'], $this->noBuild)) {
                $html[] = '<div class="col-xl"><a href="' . sprintf('https://travis-ci.com/%s/branches',
                        $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://travis-ci.com/%s.svg?branch=master',
                        $repo['fullName']) . '" alt="Build Status"></a></div>';
            } else {
                $html[] = '<div class="col-xl"></div>';
            }
            if (!in_array($repo['name'], $this->noTests)) {
                $html[] = '<div class="col-xl"><a href="' . sprintf('https://coveralls.io/github/%s?branch=master',
                        $repo['fullName']) . '" target="_blank"><img src="' . sprintf('https://coveralls.io/repos/github/%s/badge.svg?branch=master',
                        $repo['fullName']) . '" alt="Coverage Status"></a></div>';
            } else {
                $html[] = '<div class="col-xl"></div>';
            }

            $html[] = '</div>';
            $html[] = '</div>';
            $html[] = '</div>';
        }
        return implode($html, PHP_EOL);
    }
}

(new GithubReposPageGenerator())->generate('ixocreate', 'ixocreate_theme/repos.html');


module.exports = function(gulp, plugins, config, extra) {

  var count = extra.sprites.length;
  var callback;

  var generate = function(name) {
    var options = {
      imgName: 'sprite-' + name + '.png',
      imgPath: extra.relative_sprites_path + 'sprite-' + name + '.png',
      cssName: '_sprite-' + name + '.scss',
      cssVarMap: function(sprite) {
        sprite.name = 'sprite-' + name + '-' + sprite.name;
      }
    };

    if(extra.enable_retina_sprites) {
      options.retinaSrcFilter = [extra.sprites_path + name + '/*@2x.png'];
      options.retinaImgName = 'sprite-' + name + '@2x.png';
      options.retinaImgPath = extra.relative_sprites_path + 'sprite-' + name + '@2x.png';
    }

    var spriteData = gulp.src(extra.sprites_path + name + '/*.png')
      .pipe(plugins.spritesmith(options));

    spriteData.img
      .pipe(plugins.buffer())
      .pipe(plugins.imagemin())
      .pipe(gulp.dest(extra.sprites_path));

    spriteData.css
      .pipe(gulp.dest(config.src_path + '/sass/custom/sprites'))
      .on('end', function() {
        count--;
        if(count === 0) {
          callback();
        }
      });
  };

  return function(done) {
    callback = done;
    extra.sprites.forEach(function(sprite_name) {
      generate(sprite_name);
      console.log(sprite_name);
    });
  };
};

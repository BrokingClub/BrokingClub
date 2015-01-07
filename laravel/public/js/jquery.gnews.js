/*
 *  jQuery Plugin for google news search - 0.1
 *  http://triggerdesign.de
 *
 *  Made by Simon Schneider
 *  Under MIT License
 */

;(function ( $, window, document, undefined ) {

    var pluginName = "gnews",
        defaults = {
            topic: false
        };

    // The actual plugin constructor
    function Plugin ( element, options ) {
        this.element = element;
        this.$element = $(element);

        this.settings = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend(Plugin.prototype, {
        init: function () {
            var base = this;
            if(!this.settings.topic)
                this.settings.topic = this.$element.attr('data-topic');

            if(typeof(this.settings.topic) === "undefined")
                return this.noResults();

            this.newsSearch = false;

            if(google) {
                google.load('search', '1', {
                    callback: function() {
                        base.onLoad();
                    }
                } )
            }

        },

        onLoad: function () {
            var newsSearch = new google.search.NewsSearch();
            this.newsSearch = newsSearch;
            newsSearch.setSearchCompleteCallback(this, this.searchComplete, null);
            newsSearch.execute(this.settings.topic);

            google.search.Search.getBranding('branding');
        },
        searchComplete: function(){
            var results = this.newsSearch.results;
            this.$element.empty();

            this.$element.addClass('row');

            if (results && results.length > 0) {
                for (var i = 0; i < results.length; i++) {

                    var result = results[i];
                    var $result = $('<div class="gn-result col-md-12"></div>');
                    var $resultInner = $('<div class="gn-result-inner row"></div>').appendTo($result);
                    var url = decodeURIComponent(result.url);


                    if(result.image)
                        var image = '<div class="gn-image" style="background-image: url(\'' + result.image.url + '\')"></div>';
                    else
                        var image = '<div class="gn-image image-empty"></div>';

                    $image = $('<div class="col-md-4 gn-image-wrap"><a target="_blank" href="' + url + '">'+ image +'</a></div>');


                    var $content = $('<div class="gn-content col-md-8"></div>');

                    $content.append('<h3><a target="_blank" href="' + url + '">' + result.titleNoFormatting + '</a></h3>');
                    $content.append('<p>' + result.content + '</p>');


                    $resultInner.append($image);
                    $resultInner.append($content);

                    this.$element.append($result);
                }
            } else {
                this.noResults();
            }
        },
        noResults: function(){
            this.$element.text("No results");
            return false;
        }

    });


    $.fn[ pluginName ] = function ( options ) {
        this.each(function() {
            if ( !$.data( this, "plugin_" + pluginName ) ) {
                $.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
            }
        });

        // chain jQuery functions
        return this;
    };

})( jQuery, window, document );
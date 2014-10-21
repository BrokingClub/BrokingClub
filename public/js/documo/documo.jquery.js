/**
 *  Documo
 *
 *  Made by Simon Schneider @ triggerdesign.de
 *  Under MIT License
 */
// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;(function ( $, window, document, undefined ) {

    // undefined is used here as the undefined global variable in ECMAScript 3 is
    // mutable (ie. it can be changed by someone else). undefined isn't really being
    // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
    // can no longer be modified.

    // window and document are passed through as local variable rather than global
    // as this (slightly) quickens the resolution process and can be more efficiently
    // minified (especially when both are regularly referenced in your plugin).

    // Create the defaults once
    var pluginName = "documo",
        defaults = {
            markdownContainer: "#markdown-original",
            view: null,
            headings : "h1, h2, h3, h4, h5",
            section : {
                start: 'SECTION START',
                end : 'SECTION END'
            },
            tags: [
                { from: 'TOC', to: "<div class='documo-toc'></div>" },
                { from: 'DOCSTART', to: "<div class='documo-document markdown-body'>" },
                { from: 'DOCEND', to: "</div>" },
                { from: 'STARTCONTENT', to: "<div class='documo-content'>" },
                { from: 'ENDCONTENT', to: "</div>" }
            ]
        };

    // The actual plugin constructor
    function Plugin ( element, options ) {
        this.element = element;
        // jQuery has an extend method which merges the contents of two or
        // more objects, storing the result in the first object. The first object
        // is generally empty as we don't want to alter the default options for
        // future instances of the plugin
        this.settings = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend(Plugin.prototype, {
        init: function () {

            this.data = new Object();

            this.data.markdownContainer = $(this.settings.markdownContainer);

            if(this.settings.view)
                this.data.view = $(this.settings.view);
            else
                this.data.view = $(this.element);

            this.data.markdown =  this.data.markdownContainer.text();


            this.data.html = this.markdownToHtml(this.data.markdown);
            this.data.html = this.replaceTags(  this.data.html);

            this.data.view.html(this.data.html);


            this.data.html = this.createIndexes(this.data.view);
            this.data.html = this.generateToc(this.data.view, this.data.sections);


            this.setTriggers();

            this.setWidths();
            this.linkImages();
        },
        setWidths: function(){
            var totalWidth = $('.documentation-container').width();

             $('#markdown-viewer').width(totalWidth - 310);
            console.log(totalWidth);
            console.log(totalWidth);

        },
        linkImages: function(){
            $('.documo-content img').each(function(index, image){
                var src = $(image).attr('src');
                var alt = $(image).attr('alt');
               var link = '<a data-src="'+ src +'" rel="gallery" class="lightbox-image" title="'+ alt +'" href="'+ src +'"></a>';
                $(image).wrap(link);

            });
        },
        setTriggers: function(){
            var base = this;
            $( window ).scroll(function() {
                base.checkView();
            });

            $(window).on('resize', function(){
                base.setWidths();
            });
        },
        checkView: function(){

            var document = this.data.view.find('.documo-document');

            $(document).find('.in-viewport').removeClass('in-viewport');
            $('.active-heading').removeClass('active-heading');

            var inview = document.find(this.settings.headings).filter(':in-viewport');
            inview.addClass('in-viewport');

            var $activeHeading =  $(inview.first());

            $('a[title="'+ $activeHeading.attr('name') + '"').parent().addClass('active-heading');


        },
        replaceTags: function(html){
            for(var i = 0; i != this.settings.tags.length; i++){
                var tag = this.settings.tags[i];

                html = html.replace("<p>{{{ "+ tag.from +" }}}</p>", tag.to);
                html = html.replace("{{{ "+ tag.from +" }}}", tag.to);
            }


            return html;
        },
        markdownToHtml: function (markdownText) {
            console.log('convert', markdown);
            return markdown.toHTML(markdownText);
        },
        createIndexes: function(html){
            var base = this;
            var indices = [];
            var sections = {};

            var $content = $(html);
            if($content.find('.documo-content').length == 1) {
                $content = $content.find('.documo-content');
            }

            $content.find(this.settings.headings).each(function(i,e) {
                var hIndex = parseInt(this.nodeName.substring(1)) - 1;

                // just found a levelUp event
                if (indices.length - 1 > hIndex) {
                    indices= indices.slice(0, hIndex + 1 );
                }

                // just found a levelDown event
                if (indices[hIndex] == undefined) {
                    indices[hIndex] = 0;
                }

                // count + 1 at current level
                indices[hIndex]++;

                var indicesString = indices.join(".");


                sections = base.writeInObject(indices, sections, this);

                $(this).attr('data-title', $(this).text());
                $(this).prepend(indicesString + ' ');

                $(this).addClass('seciton');
                $(this).attr('name', 'section-' + indicesString);
                $(this).attr('id', 'section-' + indicesString);

                $(this).addClass('section-' + indicesString);
            });


            this.data.sections = sections;

        },
        writeInObject: function(indices, array, object){

            var parent = array;

            for(var i = 1; i != indices.length; i++){
                var parentIndex = indices.slice(0, i).join('.');

                if (typeof parent[parentIndex] != 'undefined')
                    parent = parent[parentIndex].childs;
                else {
                    alert('Your Headings are not well formed. Error at ' + indices.join('.'));
                    break;
                }
            }

            parent[indices.join('.')] = { object: object, childs: {}  };

            return array;

        },

        generateToc: function(html, sections){
            $(html).find(".documo-toc").replaceWith('<div class="documo-toc">' + this.renderTocList(sections) + "</div>");
        },
        renderTocList : function(sections){

            if(Object.keys(sections).length == 0) return "";

            var base = this;
            var list = "<ol>";


            $.each(sections, function(index, section){
                var sectionName = $(section.object).attr('name');
                list += "<li><a href='#"+ sectionName +"' title='"+ sectionName +"'>"+ $(section.object).attr('data-title') +"</a>";

                list += base.renderTocList(section.childs);

                list += "</li>";
            });

            list += "</ol>";


            return list;
        }

    });

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
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


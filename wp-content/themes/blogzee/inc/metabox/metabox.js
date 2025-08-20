jQuery(document).ready(function( $ ) {
    function blogzeeMetaboxIsActiveClassToggle( $selector ) {
        var layoutSectionContainer = $( $selector )
        if( layoutSectionContainer.length > 0 ) {
            layoutSectionContainer.on('click', '.layout-item', function(){
                var _this = $(this)
                _this.addClass('isactive').siblings().removeClass('isactive')
            })
        }
    }

    blogzeeMetaboxIsActiveClassToggle( '.sidebar-section' );   // sidebar layouts ( posts and page )
    blogzeeMetaboxIsActiveClassToggle( '.single-layouts-section' );    // single posts layouts ( posts )
    blogzeeMetaboxIsActiveClassToggle( '.taxonomy-sidebar-layouts-wrap' ); // sidebar layouts ( categories & tags )
    blogzeeMetaboxIsActiveClassToggle( '.taxonomy-archive-layouts-wrap' ); // archive layouts ( categories & tags )
})
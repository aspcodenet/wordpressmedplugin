( function( api ) {

	// Extends our custom "sports-agency" section.
	api.sectionConstructor['sports-agency'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
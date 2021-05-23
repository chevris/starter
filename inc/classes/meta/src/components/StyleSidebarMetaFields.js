/**
 * WordPress dependencies
 */
 import { Component } from '@wordpress/element';
 import { compose } from '@wordpress/compose';
 import { withDispatch, withSelect } from '@wordpress/data';
 import { __ } from '@wordpress/i18n';
 import { PanelBody, BaseControl, Button, RangeControl } from '@wordpress/components';
 
 class StyleSidebarMetaFields extends Component {
	 constructor( props ) {
		super( props );

		console.log( this.props.metas )
	 }

	 resetAll() {
		let wrapper = document.querySelector('.editor-styles-wrapper');

		this.props.setMetaValue( '_theme_slug_meta_font_size', 0 );
		wrapper.style.setProperty( 'font-size', themeslugMetaLocalize.typography.font_size + 'px' );
	}
 
	 renderTypographyFields() {
		 return (
			 <div className="themeslug-sidebar-container">
 
				 <PanelBody
					 title={ __( 'Typography', 'themeslug' ) }
					 intialOpen={ false }
				 >
					<RangeControl
						label="Font size (px)"
						value={ this.props.metas._theme_slug_meta_font_size && 0 !== this.props.metas._theme_slug_meta_font_size ? this.props.metas._theme_slug_meta_font_size : themeslugMetaLocalize.typography.font_size }
						onChange={ ( newValue ) => {
							newValue ? this.props.setMetaValue( '_theme_slug_meta_font_size', newValue) : this.props.setMetaValue( '_theme_slug_meta_font_size', 0);

							let wrapper = document.querySelector('.editor-styles-wrapper');
							newValue ? wrapper.style.setProperty( 'font-size', newValue + 'px' ) : wrapper.style.setProperty( 'font-size', themeslugMetaLocalize.typography.font_size + 'px' );
						} }
						allowReset={true}
						min={0}
						max={50}
						step="1"
					/>
				 </PanelBody>
 
			 </div>
		 );
	 }

	 renderResetAllButton() {
		return (
			<BaseControl
				label={__('Reset all settings to default', 'themeslug')}
				id="themeslug_reset_all"
				className="themeslug-reset-all components-panel__body is-opened" >
				<Button
					icon="image-rotate"
					className="themeslug-reset-all-button"
					onClick={ () => {
						this.resetAll();
					} }
					label={ __( 'Return to customizer settings', 'themeslug' ) }
					showTooltip={ true }
				/>
			</BaseControl>
		);
	}

 
	 render() {
		 return (
			 <>
				 { this.renderTypographyFields() }
				 {this.renderResetAllButton()}
			 </>
		 );
	 }
 }
 
 export default compose( [

	 withSelect( ( select ) => {
		 return {
			 getMetaValue: ( metaId ) => {
				 return select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ metaId ];
			 },
			 metas: select( 'core/editor' ).getEditedPostAttribute( 'meta' ),
		 };
	 } ),

	 withDispatch( ( dispatch ) => {
		return {
			setMetaValue: ( id, value ) => {
				dispatch( 'core/editor' ).editPost( { meta: { [ id ]: value } } );
			},
			setAllMetas: ( value ) => {
				dispatch( 'core/editor' ).editPost( { meta: value } );
			},
		};
	} ),
 
 ] )( StyleSidebarMetaFields );
 
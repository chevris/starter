/**
 * WordPress dependencies
 */
import { Component } from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { withDispatch, withSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { PanelBody, BaseControl, Button, RangeControl, ColorPalette, ColorIndicator } from '@wordpress/components';

class StyleSidebarMetaFields extends Component {
	constructor( props ) {
	super( props );

	this.wrapper = document.querySelector('.editor-styles-wrapper');

	console.log( this.props.metas )
	}

	resetAll() {
	this.props.setMetaValue( '_theme_slug_meta_font_size', 0 );
	this.props.setMetaValue( '_theme_slug_meta_background_color', '' );

	this.wrapper.style.setProperty( '--global-fs-base', themeslugMetaLocalize.typography.font_size + 'px' );
	this.wrapper.style.setProperty( '--global-cl-bg', themeslugMetaLocalize.colors.background_color );
}

	renderTypographyFields() {
		return (
		<PanelBody
			title={ __( 'Typography', 'themeslug' ) }
			intialOpen={ false }
		>
			<RangeControl
				label={ __( 'Font size (px)', 'themeslug' ) }
				value={ this.props.metas._theme_slug_meta_font_size && 0 !== this.props.metas._theme_slug_meta_font_size ? this.props.metas._theme_slug_meta_font_size : themeslugMetaLocalize.typography.font_size }
				onChange={ ( newValue ) => {
					newValue ? this.props.setMetaValue( '_theme_slug_meta_font_size', newValue) : this.props.setMetaValue( '_theme_slug_meta_font_size', 0);

					{/* newValue ? wrapper.style.setProperty( 'font-size', newValue + 'px' ) : wrapper.style.setProperty( 'font-size', themeslugMetaLocalize.typography.font_size + 'px' ); */}
					newValue ? this.wrapper.style.setProperty( '--global-fs-base', newValue + 'px' ) : this.wrapper.style.setProperty( '--global-fs-base', themeslugMetaLocalize.typography.font_size + 'px' );
				} }
				allowReset={true}
				min={0}
				max={50}
				step="1"
			/>
		</PanelBody>
		);
	}

	renderColorFields() {
		const colors = [
			{
				name: __( 'black', 'themeslug' ),
				color: '#000000',
			},
			{
				name: __( 'dark gray', 'themeslug' ),
				color: '#28303D',
			},
			{
				name: __( 'gray', 'themeslug' ),
				color: '#39414D',
			},
			{
				name: __( 'white', 'themeslug' ),
				color: '#FFFFFF',
			},
		]

		return (
			<PanelBody
				title={ __( 'Colors', 'themeslug' ) }
				intialOpen={ false }
			>
				<span>Background color</span>
				<ColorIndicator 
					colorValue={ this.props.metas._theme_slug_meta_background_color ? this.props.metas._theme_slug_meta_background_color : themeslugMetaLocalize.colors.background_color }
				/>
				<ColorPalette
					colors={ colors }
					value={ this.props.metas._theme_slug_meta_background_color ? this.props.metas._theme_slug_meta_background_color : themeslugMetaLocalize.colors.background_color }
					onChange={ ( newValue ) => {
						newValue ? this.props.setMetaValue( '_theme_slug_meta_background_color', newValue) : this.props.setMetaValue( '_theme_slug_meta_background_color', '');

						newValue ? this.wrapper.style.setProperty( '--global-cl-bg', newValue ) : this.wrapper.style.setProperty( '--global-cl-bg', themeslugMetaLocalize.colors.background_color );
					} }
				/>
			</PanelBody>
		);
	}

	 renderResetAllButton() {
		return (
			<BaseControl
				label={__('Reset all settings to default', 'themeslug')}
				id="themeslug_reset_all"
				className="themeslug-reset-all components-panel__body is-opened"
			>
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
				 { this.renderColorFields() }
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
 
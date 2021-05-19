/**
 * WordPress dependencies
 */
import { Component } from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { withDispatch, withSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { PanelBody, BaseControl, Button, RangeControl, FontSizePicker } from '@wordpress/components';

class PostStyleSidebarMetaFields extends Component {
	constructor( props ) {
		super( props );

		// Retrieve all meta object.
		const metaData = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' );

		// Function to remove object keys with empty value.
		const omitEmpty = ( obj ) => {
			Object.keys( obj ).filter( ( k ) => '' === obj[ k ] || 0 === obj[ k ] ).forEach( ( k ) => delete ( obj[ k ] ) );
			return obj;
		};

		// Default values of meta used in the sidebar.
		this.defaultState = {
			themeslug_meta_font_size: null,
		};

		// Remove meta whose value is not set yet and use value that have been set and default otherwise.
		const result = { ...omitEmpty( this.defaultState ), ...omitEmpty( metaData ) };

		// Remove meta keys that are not in the sidebar.
		for ( const k in result ) {
			if ( ! Object.keys( this.defaultState ).includes( k ) ) {
				delete ( result[ k ] );
			}
		}

		this.state = { ...result };

		this.updateValues = this.updateValues.bind( this );
	}

	updateValues( id, value ) {
		const state = this.state;
		state[ id ] = value;
		this.setState( state );
		this.props.setMetaValue( id, value );
	}

	resetAll() {
		const state = this.state; // Default state.
		const allMeta = { ...this.props.allMeta }; // Modified metas.

		// Clear metas that have been set.
		const clearedMetas = {};

		// Empty metas of the state and fill clearedMetas.
		Object.keys( state ).forEach( ( item ) => {
			let emptyValue = '';
			if ( 'themeslug_meta_font_size' === item ) {
				emptyValue = 0;
			}
			clearedMetas[ item ] = emptyValue;
		} );

		// Keep only metas that have been set.
		for ( const k in clearedMetas ) {
			if ( ! Object.keys( allMeta ).includes( k ) ) {
				delete clearedMetas[ k ];
			}
		}

		// Replace metas that have been set with empty metas.
		this.props.setAllMetas( {
			...allMeta,
			...clearedMetas,
		} );

		// Restore default state.
		this.setState( this.defaultState );
	}

	renderTypographyFields() {

		const fontSizes = [
			{
				name: __( 'Small' ),
				slug: 'small',
				size: 12,
			},
			{
				name: __( 'Big' ),
				slug: 'big',
				size: 26,
			},
		];

		return (
			<div className="themeslug-option-section">

				<PanelBody
					title={ __( 'Typography', 'themeslug' ) }
					intialOpen={ false }
				>
					<BaseControl
						id="themeslug_meta_font_size"
						className="themeslug-meta-control themeslug-meta-range themeslug_meta_font_size" >
						<RangeControl
							label={ __( 'Font size', 'themeslug' ) }
							value={ this.state.themeslug_meta_font_size }
							onChange={ ( value ) => {
								this.updateValues( 'themeslug_meta_font_size', value );
							} }
							min={ 0 }
							max={ 50 }
							step="1"
						/>
					</BaseControl>

					<FontSizePicker
						value={ this.state.themeslug_meta_font_size }
						onChange={ ( value ) => {
							this.updateValues( 'themeslug_meta_font_size', value );
						} }
						fontSizes={ fontSizes }
					/>
				</PanelBody>

			</div>
		);
	}

	renderReset() {
		return (
			<BaseControl
				label={ __( 'Reset all to default', 'themeslug' ) }
				id="themeslug_reset_all"
				className="themeslug-reset-all components-panel__body is-opened" >
				<Button
					icon="image-rotate"
					className="themeslug-reset-button"
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
				{ this.renderReset() }
			</>
		);
	}
}

export default compose( [

	withDispatch( ( dispatch, props ) => {
		return {
			setMetaValue: ( id, value ) => {
				dispatch( 'core/editor' ).editPost( { meta: { [ id ]: value } } );
			},
			setAllMetas: ( value ) => {
				dispatch( 'core/editor' ).editPost( { meta: value } );
			},
		};
	} ),
	withSelect( ( select, props ) => {
		return {
			metaValue: ( id ) => {
				return select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ id ];
			},
			allMeta: select( 'core/editor' ).getEditedPostAttribute( 'meta' ),
		};
	} ),

] )( PostStyleSidebarMetaFields );

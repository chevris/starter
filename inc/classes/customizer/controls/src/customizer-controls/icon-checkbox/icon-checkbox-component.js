/**
 * WordPress dependencies
 */
import { ButtonGroup, Dashicon, Tooltip, Button } from '@wordpress/components';
import { Component, Fragment } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/**
 * External dependencies
 */
import PropTypes from 'prop-types';

class IconCheckboxComponent extends Component {
	constructor() {
		super( ...arguments );

		this.updateValues = this.updateValues.bind( this );

		let value = this.props.control.setting.get();

		let defaultParams = {
			options: {
				desktop: {
					name: __( 'Desktop', 'themeslug' ),
					icon: 'desktop'
				},
				tablet: {
					name: __( 'Tablet', 'themeslug' ),
					icon: 'tablet'
				},
				mobile: {
					name: __( 'Mobile', 'themeslug' ),
					icon: 'smartphone'
				}
			}
		};

		this.controlParams = this.props.control.params.input_attrs ? {
			...defaultParams,
			...this.props.control.params.input_attrs
		} : defaultParams;

		// let baseDefault = {
		// 	'mobile': true,
		// 	'tablet': true,
		// 	'desktop': true
		// };
		// this.defaultValue = this.props.control.params.default ? this.props.control.params.default : baseDefault;
		this.defaultValue = {
			'mobile': true,
			'tablet': true,
			'desktop': true
		};
		
		value = value ? {
			...JSON.parse( JSON.stringify( this.defaultValue ) ),
			...value
		} : JSON.parse( JSON.stringify( this.defaultValue ) );
		
		this.state = {
			value: value
		};

		// console.log('defaultValue at launch: ', this.defaultValue)
		// console.log('control setting value at launch: ',this.state.value)
	}

	render() {

		const controlLabel = (
			<Fragment>
				<Tooltip text={ __( 'Reset', 'themeslug' ) }>
					<Button
						className="reset themeslug-reset"
						disabled={ ( this.state.value == this.defaultValue ) }
						onClick={ () => {
							let value = this.defaultValue;
							this.setState({ value: this.defaultValue });
							this.updateValues( value );
						} }
					>
						{/* <Dashicon icon='image-rotate' /> */}
						reset
					</Button>
				</Tooltip>
				{ this.props.control.params.label &&
					this.props.control.params.label
				}
			</Fragment>
		);

		const controlReset = (
			<Fragment>
				<Tooltip text={ __( 'Default values', 'themeslug' ) }>
					<Button
						className="reset themeslug-reset"
						onClick={ () => {
							let value = this.defaultValue;
							this.setState({ value: this.defaultValue });
							this.updateValues( value );

							{/* console.log('reset ran')
							console.log('defaultValue on reset: ', this.defaultValue)
							console.log('control setting value on reset: ',this.props.control.setting.get()) */}
						} }
					>
						reset
					</Button>
				</Tooltip>
			</Fragment>
		);

		return (
			<div className="themeslug-control-field themeslug-radio-icon-control">
				{/* <div className="themeslug-responsive-control-bar">
					<span className="customize-control-title">{ controlLabel }</span>
				</div> */}
				<div className="themeslug-responsive-control-bar">
					<span className="customize-control-title">
						{ this.props.control.params.label &&
							this.props.control.params.label
						}
					</span>
					<div className="side-control">
						{ controlReset }
					</div>
				</div>
				<ButtonGroup className="themeslug-radio-container-control">
					{ Object.keys( this.controlParams.options ).map( ( item ) => {
						return (
							<Fragment>
								<Tooltip text={ this.controlParams.options[ item ].name }>
									<Button
										isTertiary
										className={ ( true === this.state.value[ item ] ? 'active-radio ' : '' ) + item }
										onClick={ () => {
											let value = this.state.value;
											if ( value[ item ]) {
												value[ item ] = false;
											} else {
												value[ item ] = true;
											}
											this.setState({ value: value });
											this.updateValues( value );
										} }
									>
										{ this.controlParams.options[ item ].icon && (
											<span className="themeslug-radio-icon">
												{ <Dashicon icon={this.controlParams.options[ item ].icon}/> }
											</span>
										) }
										{ ! this.controlParams.options[ item ].icon && (
											<span className="themeslug-radio-name">
												{ this.controlParams.options[ item ].name }
											</span>
										) }
									</Button>
								</Tooltip>
							</Fragment>
						);
					})}
				</ButtonGroup>
			</div>
		);
	}

	updateValues( value ) {
		this.props.control.setting.set({
			...this.props.control.setting.get(),
			...value,
			// flag: ! this.props.control.setting.get().flag
		});
		// console.log('updateValues ran')
		// console.log('defaultValue on click: ', this.defaultValue)
		// console.log('control setting value on click: ',this.props.control.setting.get())
	}
}

export default IconCheckboxComponent;

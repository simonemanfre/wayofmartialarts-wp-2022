//https://github.com/bigbite/gutenberg-postlist-demo/blob/master/src/block/block.js
/*
* 
* Blocks dynamic data
*
*/
var cats = [];
Object.entries( fabc_gutenberg_cats ).forEach(
    ([key, value]) => cats.push( value )
);


/*
* 
* Import CSS/SCSS file
*
*/
import './editor.scss';


/*
* 
* Import components
*
*/
import { Panel, PanelBody, PanelRow } from '@wordpress/components';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { SelectControl, ColorPicker, TextControl, TextareaControl } from '@wordpress/components';
import { useState, Component } from '@wordpress/element';


/*
* 
* Main Const
*
*/
const { registerBlockType } = wp.blocks;


/*
* 
* Home Header
*
*/
registerBlockType( 'fabc-astra-child/home-header', {
	title: 'FABC Home Header',
	icon: 'smiley',
	category: 'theme',
	attributes: {
		gradient_color:      { type: 'string'},
		main_cat_id:         { type: 'string'},
		highlighted_cat_ids: { type: 'array'},
	},
	edit: class extends Component {

		constructor( props ) {
			super(...arguments);
			this.props = props ;
		}

		render() {
			return (
				<div className="fabc-content-block">
					<InspectorControls>
						<Panel>
							<PanelBody title = "Settings">
							<label>Primary Gradient Color</label>
							<ColorPicker
					            color            = { this.props.attributes.gradient_color }
					            onChangeComplete = {
					            	( gradient_color ) => {
								        this.props.setAttributes( {gradient_color: gradient_color.hex } )  
								    }
					            }
					            enableAlpha
					            defaultValue="#fbc724"
					        />
							<SelectControl
					            label    = "Main Category"
					            value    = { this.props.attributes.main_cat_id }
					            options  = { cats }
					            onChange = {
					            	( main_cat_id ) => {
								        this.props.setAttributes( {main_cat_id: main_cat_id} ) 
								    }
					            }
					        />
					        <SelectControl
							    multiple
							    label    = "Highlighted Categories"
							    options  = { cats }
							    value    = { this.props.attributes.highlighted_cat_ids } 
							    onChange = {
							    	( cat_ids ) => {
								        this.props.setAttributes( {highlighted_cat_ids: cat_ids} )
								    } 
								}
							/>
							</PanelBody>
						</Panel>
					</InspectorControls>
					<h3>
						FABC Home Header
					</h3>
				</div>
			)
		}
	},
	save: function( props ){
		return null;
	},
});



/*
* 
* Latest Articles
*
*/
registerBlockType( 'fabc-astra-child/latest-articles', {
	title: 'FABC Latest Articles',
	icon: 'smiley',
	category: 'theme',
	attributes: {
		title:               { type: 'string'},
		main_cat_id:         { type: 'string'},
		highlighted_cat_ids: { type: 'array'},
	},
	edit: class extends Component {

		constructor( props ) {
			super(...arguments);
			this.props = props ;
		}

		render() {
			return (
				<div className="fabc-content-block">
					<InspectorControls>
						<Panel>
							<PanelBody title = "Settings">
							<TextControl
					            label    ="Title"
					            value    = { this.props.attributes.title }
					            onChange = {
					            	( title ) => {
								        this.props.setAttributes( {title: title} ) 
								    }
					            }
					        /> 
							<SelectControl
					            label    = "Main Category"
					            value    = { this.props.attributes.main_cat_id }
					            options  = { cats }
					            onChange = {
					            	( main_cat_id ) => {
								        this.props.setAttributes( {main_cat_id: main_cat_id} ) 
								    }
					            }
					        />
					        <SelectControl
							    multiple
							    label    = "Highlighted Categories"
							    options  = { cats }
							    value    = { this.props.attributes.highlighted_cat_ids } 
							    onChange = {
							    	( cat_ids ) => {
								        this.props.setAttributes( {highlighted_cat_ids: cat_ids} )
								    } 
								}
							/>
							</PanelBody>
						</Panel>
					</InspectorControls>
					<h3>
						FABC Latest Articles
					</h3>
				</div>
			)
		}
	},
	save: function( props ){
		return null;
	},
});



/*
* 
* Trending
*
*/
registerBlockType( 'fabc-astrsa-child/trending-widget', {
	title: 'FABC Trending',
	icon: 'smiley',
	category: 'theme',
	attributes: {
		title:   { type: 'string'},
		tag_ids: { type: 'string'},
	},
	edit: class extends Component {

		constructor( props ) {
			super(...arguments);
			this.props = props ;
		}

		render() {
			return (
				<div className="fabc-content-block">
					<InspectorControls>
						<Panel>
							<PanelBody title = "Settings">
							<TextControl
					            label    ="Title"
					            value    = { this.props.attributes.title }
					            onChange = {
					            	( title ) => {
								        this.props.setAttributes( {title: title} ) 
								    }
					            }
					        /> 
						   <TextareaControl
					            label    ="Tag IDs"
					            help     ="Enter one ID per line."
					            value    = { this.props.attributes.tag_ids }
					            onChange = {
					            	( tag_ids ) => {
								        this.props.setAttributes( {tag_ids: tag_ids} ) 
								    }
					            }
					        />
							</PanelBody>
						</Panel>
					</InspectorControls>
					<h3>
						FABC Trending
					</h3>
				</div>
			)
		}
	},
	save: function( props ){
		return null;
	},
});


/*
* 
* Trending Sticky
*
*/
registerBlockType( 'fabc-astrsa-child/trending-widget-sticky', {
	title: 'FABC Trending Sticky',
	icon: 'smiley',
	category: 'theme',
	attributes: {
		title:       { type: 'string'},
		main_cat_id: { type: 'string'},
	},
	edit: class extends Component {

		constructor( props ) {
			super(...arguments);
			this.props = props ;
		}

		render() {
			return (
				<div className="fabc-content-block">
					<InspectorControls>
						<Panel>
							<PanelBody title = "Settings">
							<TextControl
					            label    ="Title"
					            value    = { this.props.attributes.title }
					            onChange = {
					            	( title ) => {
								        this.props.setAttributes( {title: title} ) 
								    }
					            }
					        />
					        <SelectControl
					            label    = "Main Category"
					            value    = { this.props.attributes.main_cat_id }
					            options  = { cats }
					            onChange = {
					            	( main_cat_id ) => {
								        this.props.setAttributes( {main_cat_id: main_cat_id} ) 
								    }
					            }
					        /> 
							</PanelBody>
						</Panel>
					</InspectorControls>
					<h3>
						FABC Trending Sticky
					</h3>
				</div>
			)
		}
	},
	save: function( props ){
		return null;
	},
});


/*
* 
* Trending Sticky
*
*/
registerBlockType( 'fabc-astrsa-child/related-post', {
	title: 'FABC Related Post',
	icon: 'smiley',
	category: 'theme',
	attributes: {
		keywords:  { type: 'string'},
		post_data: { type: 'string'},
	},
	edit: class extends Component {

		constructor( props ) {
			super(...arguments);
			this.props = props ;
		}

		render() {
			return (
				<div className="fabc-content-block">
					<InspectorControls>
						<Panel>
							<PanelBody title = "Settings">
								<div className="fabc-related-post" id={generate_random_string(20)}>
									<TextControl
						        	    className  ="fabc-related-post-keywords"
						        	    placeholder="Enter keywords and hit enter"
						        	    value      = { this.props.attributes.keywords }
							            onChange   = {
							            	( keywords ) => {
										        this.props.setAttributes( {keywords: keywords} ) 
										    }
							            }
						        	/>
						        	<div className="fabc-dynamic-results">
										<h4><strong>Select Related Post</strong> <div class="fabc-loader"></div></h4>
										<SelectControl
								            value    = { this.props.attributes.post_data }
								            options  = { [ { value: null, label: 'Select' } ] }
								            onChange = {
								            	( post_data ) => {
											        this.props.setAttributes( {post_data: post_data} ) 
											    }
								            }
								        />
							        </div>
								</div>
							</PanelBody>
						</Panel>
					</InspectorControls>
					<h3>
						FABC Related Post
						<p>{ print_related_post( this.props.attributes.post_data ) }</p>
					</h3>
				</div>
			)
		}
	},
	save: function( props ){
		return null;
	},
});



/**
 * 
 * Generate Random String
 * 
 */
function generate_random_string( length ) {
	var result           = '';
	var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	var charactersLength = characters.length;
	for ( var i = 0; i < length; i++ ) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}
	return result;
}


/**
 * 
 * Print Related Post In Admin
 * 
 */
function print_related_post( prop ) {
	if( prop ){
		return JSON.parse( prop ).label;
	}
}
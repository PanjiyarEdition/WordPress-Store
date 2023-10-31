import { __ } from "@wordpress/i18n";
import { Fragment } from "@wordpress/element";
import {useBlockProps, InnerBlocks, RichText } from '@wordpress/block-editor';
import BlockInspector from "./Inspector";

export default ({
	attributes,
	setAttributes,
	className,
	isSelected
}) => {
    const {
        pinLabel,
    } = attributes;

    const TEMPLATE = [
        [ 'core/embed', {} ] 
    ];

	return (
        <div { ...useBlockProps() }>
            <Fragment>          
                <BlockInspector
                    {...{ attributes, setAttributes, className, isSelected }}
                />
                <section id="rishi_pinterest" className="rishi_sidebar_widget_pinterest">                   
                    { pinLabel && 
                        (
                            <RichText
                                placeholder={__("Enter Title Here", "rishi-companion")}
                                value={pinLabel}
                                className="widget-title"
                                tagName="h2"
                                formattingControls={[
                                    "bold",
                                    "italic",
                                    "underline",
                                ]}					
                                onChange={(newLabel) =>
                                    setAttributes({ pinLabel: newLabel })
                                }
                            /> 
                        )
                    }                  
                    <InnerBlocks                   
                        templateLock="all"
                        template={ TEMPLATE }
                    />               
                </section>
            </Fragment>
        </div>
	);
};
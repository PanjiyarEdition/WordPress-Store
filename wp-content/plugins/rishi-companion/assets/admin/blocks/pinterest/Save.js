import { __ } from "@wordpress/i18n";
import {useBlockProps, InnerBlocks, RichText } from '@wordpress/block-editor';

export default ({ attributes }) => {
	const {
        pinLabel
	} = attributes;

    return (
        <div { ...useBlockProps.save() }>
            <section id="rishi_pinterest" className="rishi_sidebar_widget_pinterest">
                { pinLabel &&
                    (
                        <RichText.Content
                            value={pinLabel}
                            className="widget-title"
                            tagName="h2"
                        />
                    )
                }
                <InnerBlocks.Content />
            </section>
        </div>
	);
};
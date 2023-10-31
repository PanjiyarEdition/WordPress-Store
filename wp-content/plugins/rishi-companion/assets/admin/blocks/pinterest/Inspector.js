import { __ } from "@wordpress/i18n";
import { PanelBody, TextControl } from "@wordpress/components";
import { InspectorControls } from "@wordpress/block-editor";

export default ({ attributes, setAttributes }) => {
	const {
		pinLabel
	} = attributes;

	return (
        <InspectorControls key="inspector">
            <PanelBody>
                <div className="rishi-blocks-option">                
                    <TextControl
                        label={__("Pinterest Block Title", "rishi-companion")}
                        className="recent-posts-title rishi-input-field"
                        value={pinLabel}
                        onChange={(pinLabel) => setAttributes({ pinLabel })}
                    />
                </div>
            </PanelBody>
        </InspectorControls>
    )
}
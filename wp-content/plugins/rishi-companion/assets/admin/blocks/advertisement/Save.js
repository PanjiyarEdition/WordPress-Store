import { __ } from "@wordpress/i18n";

export default ({ attributes }) => {
	const {
		advertisementLabel,
		advertisementType,
		advertisementImageID,
		advertisementImageURL,
		advertisementImageAlt,
		advertisementFeaturedLink,
		openInNewTab,
		relAttributeNofollow,
		relAttributeSponsored,
		advertisementCode				
	} = attributes;
	
	var target 	= openInNewTab ? '_blank' : '_self'
	var rel    	= 'noopener'

	if( relAttributeNofollow && relAttributeSponsored ) {
		rel = 'noopener nofollow sponsored'	
	}else if( relAttributeNofollow ){
		rel = 'noopener nofollow'
	}else if( relAttributeSponsored ){ 
		rel = 'noopener sponsored'
	}
    
    return (
        <section id="rishi_advertisement" className="rishi_sidebar_widget_advertisement">
			<div className="bttk-add-holder">
				<div className="bttk-add-inner-holder">
				{advertisementLabel ? <h2 className="widget-title" itemProp="name"><span>{advertisementLabel}</span></h2>  : '' }
					{advertisementType == 'ad_image' && advertisementImageID && (
						<div className="icon-holder">
							{
								advertisementFeaturedLink ? (
									<a target={`${target}`} href={`${advertisementFeaturedLink}`} className="post-thumbnail" rel={rel}>
										<img
											className="image-preview"
											src={advertisementImageURL} alt={advertisementImageAlt}
										/>
									</a>
								) : (
									<img
										className="image-preview"
										src={advertisementImageURL} alt={advertisementImageAlt}
									/>
								)
							}
						</div>
					)}
					{advertisementType == 'ad_code' &&
						<div className="advert-preview"
						dangerouslySetInnerHTML={{
							__html: advertisementCode,
						}}
						/>
					}
				</div>
			</div>
		</section>
    );
};

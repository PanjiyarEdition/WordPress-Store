import { __ } from "@wordpress/i18n";
import { RichText,InnerBlocks } from "@wordpress/block-editor";
export default ({ attributes }) => {
    const {
      authorBioTitle,
      authorBioLabel,
      authorBioType,
      authorBioImageID,
      authorBioImageURL,
      authorBioImageAlt,
      authorBioDesc,
      authorBioGravatar,
      authorBioSignImageURL,
      authorBioSignImageID,
      authorBioSignImageAlt,
      authorBioImageSize,
      authorBioBtnLabel,
      authorBioBtnUrl,
      authorBioImageShape,
      authorBioAlignment
    } = attributes;

    const validateEmail = (email) => {
        return String(email)
          .toLowerCase()
          .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          );
      };

    var md5 = require('md5');

    return (
            <section id="rishi_author_bio" className="rishi_sidebar_widget_author_bio" data-author-shape={ authorBioImageShape } data-author-alignment={ authorBioAlignment }>
            <h2 className="widget-title" itemProp="name"><span>{ authorBioTitle }</span></h2>
            {
                authorBioType == 'authorbioimage' && authorBioImageID && (
                    <div className="icon-holder">
                        {
                            <img
                                className="image-preview"
                                width= {authorBioImageSize}
                                height= {authorBioImageSize}
                                src={authorBioImageURL} alt={authorBioImageAlt}
                            />
                        }
                    </div>
                )
            }
            <span className="authorname">{authorBioLabel}</span>
            {authorBioType == 'gravatar' && authorBioGravatar && (
                    <div className="icon-holder">
                        {
                            validateEmail( authorBioGravatar ) ?
                            <img 
                                className="image-preview"
                                width= {authorBioImageSize}
                                height= {authorBioImageSize}
                                src={ `https://www.gravatar.com/avatar/${md5(authorBioGravatar)}?s=${authorBioImageSize}` }
                            />
                            : 
                            <span>{ __( 'Please use the valid gravatar email address.','rishi-companion' ) }</span>
                        }
                    </div>
                )}
            <div className="desc-holder">
                <RichText.Content tagName="p" value={ authorBioDesc } />
            </div>
            { authorBioSignImageID && (
                    <div className="sign-icon-holder">
                        {
                            <img
                                className="image-preview"
                                src={authorBioSignImageURL} alt={authorBioSignImageAlt}
                            />
                        }
                    </div>
                )}
            { authorBioBtnUrl && authorBioBtnLabel && (
                <a href={authorBioBtnUrl} className = "readmore-btn rishi-btn">
                    {authorBioBtnLabel}
                </a>
            )}
            <div className="block-editor-inner-blocks">
                <div className="block-editor-block-list__layout">
                  <InnerBlocks.Content />
               </div>
            </div>
       </section>  
	);
};

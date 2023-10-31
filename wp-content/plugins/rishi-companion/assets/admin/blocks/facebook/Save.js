import { __ } from "@wordpress/i18n";
export default ({ attributes}) => {
   const {
      facebookTitleLabel,
      facebookUrl,
      facebookTabs,
      facebookWidth,
      facebookHeight,
      facebookCoverPhoto,
      facebookSmallHeader,
   } = attributes;
   const coverPhoto =!facebookCoverPhoto
    return(
       <section id="rishi_facebook" className="rishi_sidebar_widget_facebook">
            {
            facebookTitleLabel ? <h2 className="widget-title"><span>{facebookTitleLabel}</span></h2> : '' 
            }
            {
            <iframe width = {facebookWidth} height = {facebookHeight} src={`https://www.facebook.com/plugins/page.php?href=${facebookUrl}&tabs=${facebookTabs}&width=${facebookWidth}&height=${facebookHeight}&small_header=${facebookSmallHeader}&hide_cover=${coverPhoto}&appId`} ></iframe>
            }
       </section>
   );
};
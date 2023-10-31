import { __ } from "@wordpress/i18n";
const Facebook = ({attributes,}) =>{
    const{
      facebookTitleLabel,
      facebookUrl,
      facebookTabs,
      facebookWidth,
      facebookHeight,
      facebookCoverPhoto,
      facebookSmallHeader,
   } = attributes;

	function validURL(str) {
		var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
			'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
			'((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
			'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
			'(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
			'(\\#[-a-z\\d_]*)?$','i'); // fragment locator
		return !!pattern.test(str);
	}
    const coverPhoto =!facebookCoverPhoto
    return(
        <section id="rishi_facebook" className="rishi_sidebar_widget_facebook">
          {
          facebookTitleLabel ? <h2 className="widget-title"><span>{facebookTitleLabel}</span></h2> : '' 
          } 
          { validURL( facebookUrl ) && facebookUrl ?
            <iframe width = {facebookWidth} height = {facebookHeight} src={`https://www.facebook.com/plugins/page.php?href=${facebookUrl}&tabs=${facebookTabs}&width=${facebookWidth}&height=${facebookHeight}&small_header=${facebookSmallHeader}&hide_cover=${coverPhoto}&appId`} ></iframe>
          :""}
        </section>
    );
};
export default Facebook;
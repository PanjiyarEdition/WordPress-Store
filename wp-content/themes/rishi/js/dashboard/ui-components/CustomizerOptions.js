import React from 'react';

const CustomizerOptions = (props) => {
    return (
            <div className="cards-wrapper">
                <div className="image">
                    {props.Icon}
               </div>
                <div className="title">
                    <a href={`${
                            RishiDashboard.customizer_url
                            }${encodeURI(`[section]=${props.Link}`)}`}>
                        <h6>{props.Title}</h6>
                    </a>
                </div>   
                <div className="icon">
                    <a href={`${
								RishiDashboard.customizer_url
							}${encodeURI(`[section]=${props.Link}`)}`}>
                        {props.RightArrow}
                    </a>
                </div>  
            </div>
    )
}

export default CustomizerOptions;

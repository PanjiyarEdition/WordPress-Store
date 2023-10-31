const BlockSection = ({ id, sectionLabel, layoutStyle, children, className }) => {
    return <section id={id} className={className}>
        {sectionLabel ? <h2 className="widget-title"><span>{sectionLabel}</span></h2> : ''}
        <ul className={layoutStyle}>
            {children}
        </ul>
    </section>
}

export default BlockSection

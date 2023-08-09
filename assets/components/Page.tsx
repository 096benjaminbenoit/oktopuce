import React from 'react';

export default function Page({children, className = ""}) {
    return (<section className={`${className}`}>
        {children}
    </section>);
}

Page.WithNavbar = function ({children}) {
    return <Page className="">
        {/* <NavBar /> */}
        {children}
    </Page>
}
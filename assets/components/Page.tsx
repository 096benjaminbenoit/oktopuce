import React from 'react';
import NavBar from './NavBar';

export default function Page({children, className = ""}) {
    return (<section className={`${className}`}>
        {children}
    </section>);
}

Page.WithNavbar = function ({children}) {
    return <Page className="page--with-navbar">
        <NavBar />
        {children}
    </Page>
}
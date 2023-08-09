import React from "react";

import logo from '../images/logo.svg';
export default function Logo({className = ''}) {
    return (
        <img src={ logo } alt='Logo poulpe vert oktopuce' className={ className } />
    );
}
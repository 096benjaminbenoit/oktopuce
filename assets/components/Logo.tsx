import React from "react";
/** @ts-ignore */
import logo from '../images/logo.svg';
export default function Logo({className = ''}) {
    return (

        <img src={ logo } alt='logo poulpe vert sur fond noir' className={ className }></img>
    );
}
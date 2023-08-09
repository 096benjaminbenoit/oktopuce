import React from "react";
/** @ts-ignore */
import Logo from '../components/Logo';
import NavBar from "../components/NavBar";

export default function scanPage(){
    return (
    <>
        {/* AJOUTER LA NAVBAR */}
        <NavBar></NavBar>
        <section className='fullScanPage d-flex flex-column align-items-center p-3'>
            {/* Changer logo pour logo avec écriture */}
            <Logo className='m-5 logoScanPage'></Logo>
            <div className='m-5'>
                <h2 className='subtitleScanPage text-uppercase'>Flashe ton poulpe</h2>
            </div>
        </section>
    </>
    );
}

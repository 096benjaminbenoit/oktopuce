import React from "react";
/** @ts-ignore */
import Logo from '../components/Logo';

export default function scanPage(){
    return (
    <>
        {/* AJOUTER LA NAVBAR */}
        <section className='fullScanPage d-flex flex-column align-items-center p-3'>
            {/* Mettre la marge sur le parent du h1 quand elle sera dans la navBar */}
            <h1 className='homeTitle text-uppercase m-3'>Oktopuce</h1>
            <Logo className='m-5 logoScanPage'></Logo>
            <div className='m-5'>
                <h2 className='subtitleScanPage text-uppercase m-3'>Flashe ton poulpe</h2>
            </div>
        </section>
    </>
    );
}
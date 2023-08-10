import React from "react";
import Logo from '../components/Logo';
import NavBar from "../components/NavBar";

export default function scanPage(){
    return (
    <>
        {/* AJOUTER LA NAVBAR */}
        <NavBar></NavBar>
        <section className='fullScanPage d-flex flex-column align-items-center p-3'>
<<<<<<< HEAD
            {/* Mettre la marge sur le parent du h1 quand elle sera dans la navBar */}
            <h1 className='homeTitle text-uppercase m-3'>Oktopuce</h1>
            <Logo className='m-5 logoScanPage'></Logo>
            <div className='m-5'>
                <h2 className='subtitleScanPage text-uppercase m-3'>Flashe ton poulpe</h2>
=======
            {/* Changer logo pour logo avec écriture */}
            <div className="m-5">
                <Logo className='m-5 logoScanPage'></Logo>
            </div>
            <div className='m-4'>
                <h2 className='subtitleScanPage text-uppercase'>Flashe ton poulpe</h2>
>>>>>>> feature/integration
            </div>
        </section>
    </>
    );
}
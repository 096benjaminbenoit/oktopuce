import React from "react";
import Logo from '../components/Logo';
import NavBar from "../components/NavBar";
import Button from "../components/Button";
import Scan from "../components/Scan";

export default function scanPage(){
    return (
    <>
        {/* AJOUTER LA NAVBAR */}
        <NavBar></NavBar>
        <section className='fullScanPage d-flex flex-column align-items-center p-3'>
            {/* Changer logo pour logo avec écriture */}
            <div className="m-5">
                <Logo className='m-5 logoScanPage'></Logo>
            </div>
            <div className='m-4'>
                <h2 className='subtitleScanPage text-uppercase'>Flashe ton poulpe oui</h2>
                <Scan />
            </div>
        </section>
    </>
    );
}

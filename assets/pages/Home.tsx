import React from 'react';
/** @ts-ignore */
import Button from '../components/Button';
// import Button from 'react-bootstrap';
import Logo from '../components/Logo';

export default function Home(){
    return (<>
        <section className='fullHome d-flex flex-column align-items-center p-3'>
            <h1 className='homeTitle text-uppercase'>Oktopuce</h1>
            <Logo className="mt-5 p-5 logoHome"></Logo>
            <div className="btnDiv my-auto d-flex flex-column">
                <Button className='text-uppercase btnHome mb-3' variant="primary">J'ai un compte</Button>
                <Button className='text-uppercase btnHome' variant="primary">Je n'ai pas de compte"</Button>
            </div>
        </section>
    </>);
}

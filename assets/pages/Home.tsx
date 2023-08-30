import React from 'react';
/** @ts-ignore */
import Button from '../components/Button';
// import Button from 'react-bootstrap';
import Logo from '../components/Logo';

export default function Home(){
    return (<>
        <section className='fullHome d-flex flex-column align-items-center p-5'>
            <div className='p-3'>
                <h1 className='homeTitle display-1 fw-bold text-uppercase'>Oktopuce</h1>
            </div>
            <div className='m-3'>
                <Logo className="mt-5 logoHome"></Logo>
            </div>
            <div className="btnDiv my-auto d-flex flex-column">
                <Button.Link path='/login' className='text-uppercase btnHome mb-3' variant="primary">J'ai un compte</Button.Link>
                <Button className='text-uppercase btnHome' variant="primary">Je n'ai pas de compte</Button>
            </div>
        </section>
    </>);
}

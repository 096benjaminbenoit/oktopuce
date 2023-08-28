import React from 'react'
import Logo from '../components/Logo'
import Button from '../components/Button'

export default function ProfilChoice() {
  return (
    <section className='fullHome d-flex flex-column align-items-center p-5'>
            <div className='p-3'>
                <h1 className='homeTitle display-1 fw-bold text-uppercase'>Oktopuce</h1>
            </div>
            <div className='m-3'>
                <Logo className="mt-5 logoHome"></Logo>
            </div>
            <div className="btnDiv my-auto d-flex flex-column">
                <Button.Link path='/scan' className='text-uppercase btnHome mb-3' variant="primary">Je suis un particulier</Button.Link>
                <Button.Link path="/scan" className='text-uppercase btnHome' variant="primary">Je suis un professionnel</Button.Link>
            </div>
        </section>
  )
}

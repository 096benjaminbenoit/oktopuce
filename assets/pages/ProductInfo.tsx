import React from 'react';
import ClimInfo from '../components/ClimInfo';
import NavBar from '../components/NavBar';

export default function ProductInfo() {
  return (<>
    <NavBar></NavBar>
    <section className='d-flex flex-column align-items-center'>
      <ClimInfo></ClimInfo>
    </section>
  </>
  );
}
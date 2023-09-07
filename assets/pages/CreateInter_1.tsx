import React from 'react'
import FormCreateInter from '../components/FormCreateInter';
import NavBar from '../components/NavBar';
import Button from '../components/Button';

export default function CreateInterEtape1() {
  return (<>
    <NavBar />

    <section className='infosUser d-flex flex-column'>
      <div className="container text-center mt-4">
        <h1>Nouvelle Intervention</h1>
      </div>
      <div className="container mt-4">
        <div className="card mx-auto" style={{ maxWidth: "500px" }}>
          <div className="card-body">
            <div className='formInfosContainer m-3'>
              <FormCreateInter />
            </div>
          </div>
        </div>
      </div>

    </section>
  </>
  );
}
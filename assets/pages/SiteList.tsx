import React from 'react';
import NavBar from '../components/NavBar';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';
import { useQuery } from '@tanstack/react-query';
import { Spinner } from 'react-bootstrap';

import type { Site } from '../api/type';

export default function SiteList() {
  const { isLoading: isSiteLoading, error: siteError, data: site } = useQuery({
    queryKey: ['site'],
    queryFn: () => fetch('/api/site.jsonld').then(res => res.json()),
  });

  if (isSiteLoading) {
    return <Spinner />;
  }

  const sites: Site[] = site["hydra:member"];

  return (<>
    <NavBar/>

    <section className='siteListContainer d-flex flex-column justify-content-around'>
      
      <h1 className='titleInfosUser text-uppercase m-2'>Sites enregistrés</h1>
      
      
      {/* <ul className="siteList m-5">
        <li className='site site1'>Maison Perso</li> 
        <li className='site site2'>Bureau</li>
      </ul> */}

      <Button.Link path='/site' className='text-uppercase btnInfosUser m-5' variant="primary"> Ajouter un site </Button.Link>
    </section>
    </>
  );
}
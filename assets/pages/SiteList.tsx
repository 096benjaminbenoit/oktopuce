import React from 'react';
import NavBar from '../components/NavBar';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';
import { useQuery } from '@tanstack/react-query';
import Site from './Site';
import { Spinner } from 'react-bootstrap';
import { Link } from 'react-router-dom';

type Site = {
    "@context": string,
    "@id": string,
    "@type": string,
    "id": 0,
    "address": string,
    "city": string,
    "postCode": string,
    "name": string,
    "client": string,
    "contacts": [
      string
    ]
}

export default function SiteList() {
  const { isLoading: isSiteLoading, error: siteError, data: site } = useQuery({
    queryKey: ['sites'],
    queryFn: () => fetch('/api/sites.jsonld').then(res => res.json()),
  });

  if (isSiteLoading) {
    return <Spinner />;
  }

  const sites: Site[] = site["hydra:member"];

  return (<>
    <NavBar/>

    <section className='siteListContainer d-flex flex-column justify-content-around'>
      
      <h1 className='titleInfosUser text-uppercase m-2'>Sites enregistrés</h1>
      
      <div className="container mt-4">
        <div className="card m-auto " style={{ maxWidth: "500px" }}>
          <div className="card-body p-5">
            {sites.map(site => (
              <div key={site['@id']} className="site-item">
                <ul>
                  <li>
                  <Link to={'/equipementlist'}>{site.name}</Link>
                  </li>
                </ul>
              </div>
            ))}
            <Link to={''}></Link>
          </div>
        </div>
      </div>
      <Button.Link path='/site' className='text-uppercase btnInfosUser m-5' variant="primary"> Ajouter un site </Button.Link>
      
    </section>
    </>
  );
}
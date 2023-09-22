import React from 'react';
import NavBar from '../components/NavBar';
import Button from '../components/Button';
import { useQuery } from '@tanstack/react-query';
import { Spinner } from 'react-bootstrap';
import { Link } from 'react-router-dom';

type Site = {
  "@context": string,
  "@id": string,
  "@type": string,
  "id": number,
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
    <NavBar />

    <div className="container text-center mt-4">
        <h1>Sites enregistrés</h1>
      </div>
      
      <div className="container mt-4">
        <div className="card m-auto " style={{ maxWidth: "500px" }}>
          <div className="card-body p-5">
            <div>
              <ul>
                {sites.map(site => (
                  <li key={site['@id']} className="site-item">
                    <Link to={'/equipementlist'}>{site.name}</Link>
                  </li>
                ))}
              </ul>
            </div>
            <Link to={''}></Link>
          </div>
        </div>
        <div className="container text-center mt-3">
          <Button.Link path='/site' className="text-uppercase btnHome mb-3" variant="primary">
          Ajouter un site 
          </Button.Link>
        </div>
      </div>
      
    </>
  );
}
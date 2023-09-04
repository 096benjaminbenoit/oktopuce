import React from 'react';
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import Logo from '../components/Logo';


function NavBar() {
  return (<>
    <Navbar collapseOnSelect expand="lg" className="bg-secondary navbar-dark">
      <Container>
        <Logo className='bg-white rounded-circle m-2 p-2 NavBarLogo'></Logo>
        <Navbar.Brand href="/scan"><h1 className='homeTitle text-uppercase'>Oktopuce</h1></Navbar.Brand>
        <Navbar.Toggle aria-controls="responsive-navbar-nav" />
        <Navbar.Collapse id="responsive-navbar-nav">
          <Nav className="me-auto">
            <Nav.Link href="/infos">Creation nouveau profil</Nav.Link>
            <Nav.Link href="#historique">Historique</Nav.Link>
            <Nav.Link href="/create_inter">Interventions</Nav.Link>
          </Nav>
          <Nav>
            <Nav.Link href="#connexion">Deconnexion</Nav.Link>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
    </>
  );
}

export default NavBar;
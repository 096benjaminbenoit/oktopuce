import React from 'react';
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import Logo from '../components/Logo';
import { useContext } from 'react';
import { LoginContext, LoginDispatchContext } from '../context/LoginContext';
import { useNavigate } from 'react-router-dom';


function NavBar() {
  const navigate = useNavigate();
  const dispatch = useContext(LoginDispatchContext);
  const logout =()=>{
    dispatch({
      type: 'logout',
    });
    navigate('/');
  };

  const isLogin = useContext(LoginContext)?.loggedIn;


  return (<>
    <Navbar collapseOnSelect expand="lg" className="bg-secondary navbar-dark">
      <Container>
        <Logo className='bg-white rounded-circle m-2 p-2 NavBarLogo'></Logo>
        <Navbar.Brand href="/scan"><h1 className='homeTitle text-uppercase'>Oktopuce</h1></Navbar.Brand>
        <Navbar.Toggle aria-controls="responsive-navbar-nav" />
        <Navbar.Collapse id="responsive-navbar-nav">
          <Nav className="me-auto">
            <Nav.Link href="/infos">Création d'un nouveau profil</Nav.Link>
            <Nav.Link href="#historique">Données de l'équipement</Nav.Link>
            {/* <Nav.Link href="/create_inter"></Nav.Link> */}
          </Nav>
          <Nav>
            {
              isLogin ? <Nav.Link  onClick={logout} href="#connexion">Déconnexion</Nav.Link> : null
            }
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
    </>
  );
}

export default NavBar;
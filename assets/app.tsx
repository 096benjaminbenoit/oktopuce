/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

import React from 'react';
import { createRoot } from 'react-dom/client';
import Home from './pages/Home';
import ScanPage from './pages/ScanPage';

// Clear the existing HTML content
document.body.innerHTML = '<div id="app"></div>';

// Render your React component instead
const root = createRoot(document.getElementById('app'));
root.render(
<>
  {/* <Home/> */}
  <ScanPage/>
</>
);
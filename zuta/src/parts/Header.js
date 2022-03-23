import React, { useState } from 'react';
import { Link } from 'react-router-dom';

import BrandIcon from 'parts/IconText';
import Search from 'parts/Search';
import Navbar from 'parts/Navbar';
// import { Router, Route } from 'react-router-dom';

export default function Header(props) {
  const [isLoged, setLogin] = useState(false);

  return (
    <div className="container">
      <div className="row">
        <div className="contact col-md-6">
          <div className="row">
            <div className="col-sm-4">
              <p>contact@example.com</p>
            </div>
            <div className="col-sm-4">
              <p>nomer wa</p>
            </div>
          </div>
        </div>
        <div className="account col-md-6">
          <div className="row">
            {/* <div className="col-sm-4">
              <p>my account</p>
            </div> */}
            <div className="col-sm-4">{!isLoged ? <Link to="/login">Login</Link> : <p>My Account</p>}</div>
          </div>
        </div>
      </div>
      <div className="d-flex row">
        <BrandIcon />
        <Search />
        <section className="col-sm-3 d-flex">
          <div className="likes col-sm-6">
            <p>likes</p>
          </div>
          <div className="cart col-sm-6">
            <p>cart</p>
          </div>
        </section>
      </div>
      <div className="row">
        <Navbar></Navbar>
      </div>
    </div>
  );
}

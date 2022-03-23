import React, { Component } from 'react';
import imgLogin from 'assets/images/slide1.png';

export default class Login extends Component {
  render() {
    return (
      <div className="container d-flex" style={{ margin: '40vh auto' }}>
        <div className="col-4">
          <img className="img-fluid" src={imgLogin} alt="" />
        </div>
        <div className="col-8">
          <form action="/" className="d-flex flex-column">
            <label>
              <p>Username</p>
              <input className="w-75" type="text" />
            </label>
            <label>
              <p>Password</p>
              <input className="w-75" type="password" />
            </label>
            <div>
              <button type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    );
  }
}

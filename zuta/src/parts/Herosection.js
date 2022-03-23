import React from 'react';
import Carousel from 'react-bootstrap/Carousel';
import slide1 from 'assets/images/slide1.png';
import slide2 from 'assets/images/slide2.jpg';
import slide3 from 'assets/images/slide3.jpg';

export default function Herosection() {
  return (
    <div className="container-fluid bg-light">
      <div className="container d-flex p-3">
        <div className="col-md-4">
          <h3>Categories</h3>
          <ul>
            <li>
              <a href="/">label1</a>
            </li>
            <li>
              <a href="/">label1</a>
            </li>
            <li>
              <a href="/">label1</a>
            </li>
            <li>
              <a href="/">label1</a>
            </li>
          </ul>
        </div>
        <div className="col-md-8">
          <Carousel fade>
            <Carousel.Item>
              <img className="d-block w-100" src={slide1} alt="First slide" />
              <Carousel.Caption>
                <h3>First slide label</h3>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
              </Carousel.Caption>
            </Carousel.Item>
            <Carousel.Item>
              <img className="d-block w-100" src={slide2} alt="Second slide" />

              <Carousel.Caption>
                <h3>Second slide label</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </Carousel.Caption>
            </Carousel.Item>
            <Carousel.Item>
              <img className="d-block w-100" src={slide3} alt="Third slide" />

              <Carousel.Caption>
                <h3>Third slide label</h3>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
              </Carousel.Caption>
            </Carousel.Item>
          </Carousel>
        </div>
      </div>
    </div>
  );
}

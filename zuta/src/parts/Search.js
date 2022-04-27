import React from 'react';

export default function Search() {
  return (
    <form className="form-inline">
      <input className="form-control mr-sm-2 col-sm-6" type="search" placeholder="Search" aria-label="Search" />
      <button className="btn btn-outline-success my-2 my-sm-0" type="submit">
        Search
      </button>
    </form>
  );
}

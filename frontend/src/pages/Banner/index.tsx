import React from 'react';

const Banner = () => {
  return (
    <div className="w-full"
      style={{
        backgroundImage: `url('https://i.imgur.com/mAGsoza.png')`,
        backgroundSize: 'contain',
        backgroundRepeat: 'no-repeat',
        height: '500px',
      }}
    ></div>
  );
};

export default Banner;

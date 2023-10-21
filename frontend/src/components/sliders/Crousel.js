import React, { useEffect } from "react";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import "./style.css";
import StoryCard from "../story/StoryCard";
import { useDispatch } from "react-redux";
import { fetchStoriesFromBackend } from "../redux/Thunks";
function SamplePrevArrow(props) {
  const { className, style, onClick } = props;
  return (
    <div
      className={className}
      style={{ ...style, display: "block", background: "#c70808", height:"100px", width:"30px", textAlign:"center", paddingTop:"40px", borderRadius:"5px"}}
      onClick={onClick}
    />
  );
}
function SampleNextArrow(props) {
  const { className, style, onClick } = props;
  return (
    <div
      className={className}
      style={{ ...style, display: "block", background: "#c70808", height:"100px", width:"30px", textAlign:"center", paddingTop:"40px", borderRadius:"5px"}}
      onClick={onClick}
    />
  );
}
const Carousel = (props) => {
  const dispatch = useDispatch();
  const settings = {
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    nextArrow: <SampleNextArrow />,
    prevArrow: <SamplePrevArrow />,
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 2,
          infinite: false,
          dots: false
        }
      },
      {
        breakpoint: 1268,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: false,
          dots: false
        }
      },
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: false,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 2,
          initialSlide: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          style:{

          }
        }
      }
    ]
  };
  useEffect(() => {
    if(props.isLoggedIn){
      dispatch(fetchStoriesFromBackend({userId:props.user.id}));
    }
  }, [dispatch]);
  return (
    <div className="cousel-container">
      <h2>Weeks's schedule</h2>
      <Slider {...settings}>
              {
                props.datas.map((data,index)=>{
                  return (
                    <div key={index}>
                  <StoryCard day={data} Dataindex={index}/>
                  </div>
                  )
                })
              }
      </Slider>
    </div>
  );
};

export default Carousel;

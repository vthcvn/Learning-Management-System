import React from "react";
import PostCard from "../PostCard";
function PostList(props) {
  return (
    <>
      {props.datas.map((item, index) => {
        return <PostCard key={index} data={item} changed={props.changed} />;
      })}
    </>
  );
}

export default PostList;

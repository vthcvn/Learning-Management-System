import React from "react";
import { SearchIcon } from "@heroicons/react/outline";
import CourseCard from "../components/CourseCard";
import AssignmentCard from "../components/AssignmentCard";
function Home() {
  return (
    <div className="container m-auto mt-5">
      <div class="flex flex-wrap">
        <div className="w-full lg:w-3/4">
          <div className="px-2 mb-5 relative">
            <div class="p-5 bg-green-400 text-white flex items-center justify-start rounded-3xl shadow-lg">
              <div className="p-5">
                <h1 className="mb-5 text-4xl lg:text-5xl font-bold">
                  Hi Stark!
                </h1>
                <p className="text-xl lg:text-3xl font-normal opacity-80">
                  You have 3 assignments this week
                </p>
                <p className="text-xl lg:text-3xl font-normal opacity-80">
                  Start your learning today.
                </p>
              </div>
            </div>
            <div className="hidden lg:block absolute top-0 right-10">
              <img
                src="./assets/img/Learning-bro.svg"
                alt=""
                className="w-64"
              />
            </div>
          </div>
          <div className="px-2">
            <div class="h-full text-grey-dark flex items-center justify-start">
              <div>
                <div className="mb-10">
                  <div className="flex justify-between lg:w-80 p-2 bg-gray-100 rounded-md relative shadow-inner">
                    <input
                      type="text"
                      className="w-full bg-gray-100 text-gray-500 focus:outline-none"
                      placeholder="What course are you looking for?"
                    />
                    <button className="absolute -top-1/4 -right-2 p-4 bg-white border-2 border-green-400 rounded-full">
                      <SearchIcon className="w-6 text-green-400 transform hover:scale-105" />
                    </button>
                  </div>
                </div>
                <div className="px-7 lg:px-0 grid grid-cols-1 lg:grid-cols-3 gap-2 gap-y-8">
                  <CourseCard />
                  <CourseCard />
                  <CourseCard />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full lg:w-1/4 px-2 pb-2">
          <div class="text-sm text-grey-dark flex items-center">
            <div className="w-full">
              <div className="w-full h-72 flex justify-center items-center border">
                <span className="text-xl text-red-500">COMING SOON</span>
              </div>
              <div className="mt-3">
                <span className="text-lg font-medium">Up Comming</span>
                <div>
                  <AssignmentCard />
                  <AssignmentCard />
                  <AssignmentCard />
                  <AssignmentCard />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Home;

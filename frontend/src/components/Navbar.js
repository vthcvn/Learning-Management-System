import React from "react";
import {
  HomeIcon,
  CollectionIcon,
  AcademicCapIcon,
  BellIcon,
  UserCircleIcon,
} from "@heroicons/react/outline";
import { NavLink } from "react-router-dom";
function Navbar() {
  return (
    <div className="bg-white w-full shadow-md sticky top-0 z-50">
      <div className="flex justify-center">
        <div className="h-14 w-full flex justify-center lg:justify-between items-center max-w-screen-xl">
          <div className="hidden lg:block">
            <img
              src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
              alt=""
              className="w-10"
            />
          </div>
          <div className="flex lg:space-x-24 space-x-2">
            <NavLink
              to="/"
              exact="/"
              className="px-5 lg:px-10 py-1 rounded-lg hover:bg-gray-100"
            >
              <HomeIcon className="w-8 text-gray-500" />
            </NavLink>
            <NavLink
              to="/courses"
              className="px-5 lg:px-10 py-1 rounded-lg hover:bg-gray-100"
            >
              <CollectionIcon className="w-8 text-gray-500" />
            </NavLink>
            <NavLink to="/forum" className="px-5 lg:px-10 py-1 rounded-lg hover:bg-gray-100">
              <AcademicCapIcon className="w-8 text-gray-500" />
            </NavLink>
            {/* <a
              href=""
              className="px-5 lg:px-10 py-1 rounded-lg hover:bg-gray-100"
            >
              <BellIcon className="w-8 text-gray-500" />
            </a> */}
          </div>
          <div>
            <UserCircleIcon className="w-8 text-gray-500" />
          </div>
        </div>
      </div>
    </div>
  );
}

export default Navbar;

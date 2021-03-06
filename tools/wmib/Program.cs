﻿//This program is free software: you can redistribute it and/or modify
//it under the terms of the GNU General Public License as published by
//the Free Software Foundation, either version 3 of the License, or
//(at your option) any later version.

//This program is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.

// Created by Petr Bena benapetr@gmail.com

using System;
using System.Collections.Generic;
using System.Text;
using System.Net;


namespace wmib
{
    class Program
    {
        public static bool Log(string msg )
        {
            Console.WriteLine("LOG: " + msg);
            return false;
        }
        static void Main(string[] args)
        {
            Log("Connecting");
            config.Load();
            irc.Connect();
        }
    }
}

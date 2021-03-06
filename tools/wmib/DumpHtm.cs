//This program is free software: you can redistribute it and/or modify
//it under the terms of the GNU General Public License as published by
//the Free Software Foundation, either version 3 of the License, or
//(at your option) any later version.

//This program is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.



using System;
using System.Collections.Generic;
using System.Text;
using System.Net;


namespace wmib
{
    public class HtmlDump
    {
        /// <summary>
        /// Channel name
        /// </summary>
        public config.channel Channel;
        /// <summary>
        /// Dump
        /// </summary>
        public string dumpname;
        // This function is called on start of bot
        public static void Start()
        {
            while (true)
            {
                foreach (config.channel chan in config.channels)
                {
                    if (chan.Keys.update)
                    {
                        HtmlDump dump = new HtmlDump(chan);
                        dump.Make();
                        chan.Keys.update = false;
                    }
                }
                System.Threading.Thread.Sleep(320000);
            }
        }
        /// <summary>
        /// Constructor
        /// </summary>
        /// <param name="channel"></param>
        public HtmlDump(config.channel channel)
        {
            dumpname = config.DumpDir + "/" + channel.name + ".htm";
            Channel = channel;
        }

        /// <summary>
        /// Html code
        /// </summary>
        /// <returns></returns>
        public string CreateFooter()
        {
            return "</body></html>\n";
        }

        /// <summary>
        /// Html
        /// </summary>
        /// <returns></returns>
        public string CreateHeader()
        {
            return "<html><head><title>"+ Channel.name +"</title></head><body>\n";
        }

        /// <summary>
        /// Remove html
        /// </summary>
        /// <param name="text"></param>
        /// <returns></returns>
        public string Encode(string text)
        {
            text = text.Replace("<", "&lt;");
            text = text.Replace(">", "&gt;");
            return text;
        }

        /// <summary>
        /// Insert another table row
        /// </summary>
        /// <param name="name"></param>
        /// <param name="value"></param>
        /// <returns></returns>
        public string AddLine(string name, string value)
        {
            return "<tr><td>" + Encode(name) + "</td><td>" + Encode(value) + "</td></tr>\n";
        }

        /// <summary>
        /// Generate a dump file
        /// </summary>
        public void Make()
        {
            try
            {
                string text;
                text = CreateHeader();
                text = text + "<table border=1 width=100%>\n<tr><td width=10%>Key</td><td>Value</td></tr>\n";
                Channel.Keys.locked = true;
                if (Channel.Keys.text.Count > 0)
                {
                    foreach (irc.dictionary.item Key in Channel.Keys.text)
                    {
                        text = text + AddLine(Key.key, Key.text);
                    }
                }
                Channel.Keys.locked = false;
                text = text + "<table>\n";
                text = text + CreateFooter();
                System.IO.File.WriteAllText(dumpname, text);
            }
            catch (Exception b)
            {
                Channel.Keys.locked = false;
                Console.WriteLine(b.Message);
            }
        }
    }
}

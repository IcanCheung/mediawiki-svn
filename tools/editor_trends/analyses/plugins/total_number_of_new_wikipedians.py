#!/usr/bin/python
# -*- coding: utf-8 -*-
'''
Copyright (C) 2010 by Diederik van Liere (dvanliere@gmail.com)
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License version 2
as published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details, at
http://www.fsf.org/licenses/gpl.html
'''

__author__ = '''\n'''.join(['Diederik van Liere (dvanliere@gmail.com)', ])
__email__ = 'dvanliere at gmail dot com'
__date__ = '2011-01-25'
__version__ = '0.1'



def total_number_of_new_wikipedians(var, editor, **kwargs):
    '''
    If you have questions about how to use this plugin, please visit:
    http://meta.wikimedia.org/wiki/Wikilytics_Plugins
    '''
    new_wikipedian = editor['new_wikipedian']
    if new_wikipedian != False:
        var.add(new_wikipedian, 1)
    return var

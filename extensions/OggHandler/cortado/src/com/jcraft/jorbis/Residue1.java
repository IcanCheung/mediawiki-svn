/* JOrbis
 * Copyright (C) 2000 ymnk, JCraft,Inc.
 *  
 * Written by: 2000 ymnk<ymnk@jcaft.com>
 *   
 * Many thanks to 
 *   Monty <monty@xiph.org> and 
 *   The XIPHOPHORUS Company http://www.xiph.org/ .
 * JOrbis has been based on their awesome works, Vorbis codec.
 *   
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public License
 * as published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
   
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Library General Public License for more details.
 * 
 * You should have received a copy of the GNU Library General Public
 * License along with this program; if not, write to the Free Software
 * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 */

package com.jcraft.jorbis;

import com.jcraft.jogg.*;

class Residue1 extends Residue0{
  int forward(Block vb,Object vl, float[][] in, int ch){
    System.err.println("Residue0.forward: not implemented");
    return 0;
  }

  int inverse(Block vb, Object vl, float[][] in, int[] nonzero, int ch){
//System.err.println("Residue0.inverse");
    int used=0;
    for(int i=0; i<ch; i++){
      if(nonzero[i]!=0){
        in[used++]=in[i];
      }
    }
    if(used!=0){
      return(_01inverse(vb,vl,in,used,1));
    }
    else{
      return 0;
    }
  }
}

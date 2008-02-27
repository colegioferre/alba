<?php

/**
 *    This file is part of Alba.
 * 
 *    Alba is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 *
 *    Alba is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with Alba; if not, write to the Free Software
 *    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/**
 * relAlumnoDivision Acciones
 *
 * @package    alba
 * @author     José Luis Di Biase <josx@interorganic.com.ar>
 * @author     Héctor Sanchez <hsanchez@pressenter.com.ar>
 * @author     Fernando Toledo <ftoledo@pressenter.com.ar>
 * @version    SVN: $Id$
 * @filesource
 * @licence GPL
 */

class relAlumnoDivisionActions extends autorelAlumnoDivisionActions
{
    protected function addFiltersCriteria ($c)                                                                                
    {                                                                                                                          
        $c->add(AlumnoPeer::FK_ESTABLECIMIENTO_ID,$this->getUser()->getAttribute('fk_establecimiento_id'));                      
        $c->addJoin(AlumnoPeer::ID,RelAlumnoDivisionPeer::FK_ALUMNO_ID);
        if (isset($this->filters['fk_alumno_id_is_empty']))                                                                      
        {                                                                                                                        
          $criterion = $c->getNewCriterion(RelAlumnoDivisionPeer::FK_ALUMNO_ID, '');                                             
          $criterion->addOr($c->getNewCriterion(RelAlumnoDivisionPeer::FK_ALUMNO_ID, null, Criteria::ISNULL));                   
          $c->add($criterion);                                                                                                   
        }                                                                                                                        
        else if (isset($this->filters['fk_alumno_id']) && $this->filters['fk_alumno_id'] !== '')                                 
        {                                                                                                                        
          $c->add(RelAlumnoDivisionPeer::FK_ALUMNO_ID, $this->filters['fk_alumno_id']);                                          
        }                                                                                                                        
        if (isset($this->filters['fk_division_id_is_empty']))                                                                    
        {                                                                                                                        
          $criterion = $c->getNewCriterion(RelAlumnoDivisionPeer::FK_DIVISION_ID, '');                                           
          $criterion->addOr($c->getNewCriterion(RelAlumnoDivisionPeer::FK_DIVISION_ID, null, Criteria::ISNULL));                 
          $c->add($criterion);                                                                                                   
        }                                                                                                                        
        else if (isset($this->filters['fk_division_id']) && $this->filters['fk_division_id'] !== '')                             
        {                                                                                                                        
          $c->add(RelAlumnoDivisionPeer::FK_DIVISION_ID, $this->filters['fk_division_id']);                                      
        }                                                                                                                        
    }  


    // Valida si ya esta en la tabla este conjunto de datos ( alumno, division )
    function validateEdit() {
         if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $rel_alumno_division = $this->getRequestParameter('rel_alumno_division');
            $c = new Criteria();
            $c->add(RelAlumnoDivisionPeer::FK_ALUMNO_ID, $rel_alumno_division['fk_alumno_id']);
            $c->add(RelAlumnoDivisionPeer::FK_DIVISION_ID, $rel_alumno_division['fk_division_id']);
            $aRelAlumnoDivision = RelAlumnoDivisionPeer::doSelect($c);
            if(count($aRelAlumnoDivision) > 0) {
                $this->getRequest()->setError('rel_alumno_division{fk_alumno_id}', 'Esta asociaci&oacute;n ya fue hecha');
                $this->getRequest()->setError('rel_alumno_division{fk_division_id}', 'Esta asociaci&oacute;n ya fue hecha');
                return false;
            }
        }
        
        return true;
    }




  public function executeEdit()
  {
    $this->rel_alumno_division = $this->getRelAlumnoDivisionOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateRelAlumnoDivisionFromRequest();
      $this->saveRelAlumnoDivision($this->rel_alumno_division);
      $this->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add')) {
        return $this->redirect('relAlumnoDivision/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('relAlumnoDivision/list');
      }
      else
      {
        return $this->redirect('relAlumnoDivision/edit?id='.$this->rel_alumno_division->getId());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }



  public function executeDelete()
  {
    $this->rel_alumno_division = RelAlumnoDivisionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->rel_alumno_division);

    try
    {
      $this->deleteRelAlumnoDivision($this->rel_alumno_division);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Rel alumno division. Make sure it does not have any associated items.');
      return $this->forward('relAlumnoDivision', 'list');
    }

    return $this->redirect('relAlumnoDivision/list');
  }



}
?>

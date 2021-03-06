<?php
/**
 * The browse view file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id: browse.html.php 4909 2013-06-26 07:23:50Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('browseType', $browseType);?>
<div id='featurebar'>
  <ul class='nav'>
    <li id='unclosedTab'>     <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=unclosed"),     $lang->product->unclosed);?></li>
    <li id='allstoryTab'>     <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=allStory"),     $lang->product->allStory);?></li>
    <li id='assignedtomeTab'> <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=assignedtome"), $lang->product->assignedToMe);?></li>
    <li id='openedbymeTab'>   <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=openedByMe"),   $lang->product->openedByMe);?></li>
    <li id='reviewedbymeTab'> <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=reviewedByMe"), $lang->product->reviewedByMe);?></li>
    <li id='closedbymeTab'>   <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=closedByMe"),   $lang->product->closedByMe);?></li>
    <li id='draftstoryTab'>   <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=draftStory"),   $lang->product->draftStory);?></li>
    <li id='activestoryTab'>  <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=activeStory"),  $lang->product->activeStory);?></li>
    <li id='changedstoryTab'> <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=changedStory"), $lang->product->changedStory);?></li>
    <li id='willcloseTab'>    <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=willClose"),    $lang->product->willClose);?></li>
    <li id='closedstoryTab'>  <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType=closedStory"),  $lang->product->closedStory);?></li>
    <li id='bysearchTab'><a href='javascript:;'><i class='icon-search icon'></i> <?php echo $lang->product->searchStory;?></a></li>
  </ul>
  <div class='actions'>
    <div class='btn-group'>
      <div class='btn-group'>
        <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
          <i class='icon-download-alt'></i> <?php echo $lang->export ?>
          <span class='caret'></span>
        </button>
        <ul class='dropdown-menu' id='exportActionMenu'>
        <?php 
        $misc = common::hasPriv('story', 'export') ? "class='export'" : "class=disabled";
        $link = common::hasPriv('story', 'export') ?  $this->createLink('story', 'export', "productID=$productID&orderBy=$orderBy") : '#';
        echo "<li>" . html::a($link, $lang->story->export, '', $misc) . "</li>";
        ?>
        </ul>
      </div>
        <?php common::printIcon('story', 'report', "productID=$productID&browseType=$browseType&moduleID=$moduleID", '', 'button', 'bar-chart'); ?>
    </div>
    <div class='btn-group'>
    <?php 
    common::printIcon('story', 'batchCreate', "productID=$productID&branch=$branch&moduleID=$moduleID", '', 'button', 'plus-sign');
    common::printIcon('story', 'create', "productID=$productID&branch=$branch&moduleID=$moduleID", '', 'button', 'plus'); 
    ?>
    </div>
  </div>
  <div id='querybox' class='<?php if($browseType =='bysearch') echo 'show';?>'></div>
</div>
<div class='side' id='treebox'>
  <a class='side-handle' data-id='productTree'><i class='icon-caret-left'></i></a>
  <div class='side-body'>
    <div class='panel panel-sm'>
      <div class='panel-heading nobr'><?php echo html::icon($lang->icons['product']);?> <strong><?php echo $branch ? $branches[$branch] : $productName;?></strong></div>
      <div class='panel-body'>
        <?php echo $moduleTree;?>
        <div class='text-right'>
          <?php common::printLink('tree', 'browse', "rootID=$productID&view=story", $lang->tree->manage);?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class='main'>
  <form method='post' id='productStoryForm'>
    <table class='table table-condensed table-hover table-striped tablesorter table-fixed' id='storyList'>
      <thead>
      <tr>
        <?php $vars = "productID=$productID&branch=$branch&browseType=$browseType&param=$moduleID&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='w-id'>  <?php common::printOrderLink('id',         $orderBy, $vars, $lang->idAB);?></th>
        <th class='w-pri'> <?php common::printOrderLink('pri',        $orderBy, $vars, $lang->priAB);?></th>
        <th class='w-p30'> <?php common::printOrderLink('title',      $orderBy, $vars, $lang->story->title);?></th>
        <th>               <?php common::printOrderLink('plan',       $orderBy, $vars, $lang->story->planAB);?></th>
        <th>               <?php common::printOrderLink('source',     $orderBy, $vars, $lang->story->source);?></th>
        <th>               <?php common::printOrderLink('openedBy',   $orderBy, $vars, $lang->openedByAB);?></th>
        <th>               <?php common::printOrderLink('assignedTo', $orderBy, $vars, $lang->assignedToAB);?></th>
        <th class='w-hour'><?php common::printOrderLink('estimate',   $orderBy, $vars, $lang->story->estimateAB);?></th>
        <th>               <?php common::printOrderLink('status',     $orderBy, $vars, $lang->statusAB);?></th>
        <th>               <?php common::printOrderLink('stage',      $orderBy, $vars, $lang->story->stageAB);?></th>
        <th class='w-140px {sorter:false}'><?php echo $lang->actions;?></th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($stories as $key => $story):?>
      <?php
      $viewLink = $this->createLink('story', 'view', "storyID=$story->id");
      $canView  = common::hasPriv('story', 'view');
      ?>
      <tr class='text-center'>
        <td class='text-left'>
          <input type='checkbox' name='storyIDList[<?php echo $story->id;?>]' value='<?php echo $story->id;?>' /> 
          <?php if($canView) echo html::a($viewLink, sprintf('%03d', $story->id)); else printf('%03d', $story->id);?>
        </td>
        <td><span class='<?php echo 'pri' . zget($lang->story->priList, $story->pri, $story->pri);?>'><?php echo zget($lang->story->priList, $story->pri, $story->pri)?></span></td>
        <td class='text-left' title="<?php echo $story->title?>"><nobr>
        <?php if($story->branch) echo "<span class='label label-info label-badge'>{$branches[$story->branch]}</span>"?>
        <?php echo html::a($viewLink, $story->title);?>
        </nobr></td>
        <td title="<?php echo $story->planTitle?>"><?php echo $story->planTitle;?></td>
        <td><?php echo $lang->story->sourceList[$story->source];?></td>
        <td><?php echo zget($users, $story->openedBy, $story->openedBy);?></td>
        <td><?php echo zget($users, $story->assignedTo, $story->assignedTo);?></td>
        <td><?php echo $story->estimate;?></td>
        <td class='story-<?php echo $story->status;?>'><?php echo $lang->story->statusList[$story->status];?></td>
        <td>
          <?php
          echo "<div" . (isset($storyStages[$story->id]) ? " class='popoverStage' data-toggle='popover' data-placement='bottom' data-target='\$next'" : '') . "'>";
          echo $lang->story->stageList[$story->stage];
          if(isset($storyStages[$story->id])) echo "<span class='pl-5px'><i class='icon icon-caret-down'></i></span>";
          echo '</div>';
          if(isset($storyStages[$story->id]))
          {
              echo "<div class='popover'>";
              foreach($storyStages[$story->id] as $storyBranch => $storyStage) echo $branches[$storyBranch] . ": " . $lang->story->stageList[$storyStage->stage] . '<br />';
              echo "</div>";
          }
          ?>
        </td>
        <td class='text-right'>
          <?php 
          $vars = "story={$story->id}";
          common::printIcon('story', 'change',     $vars, $story, 'list', 'random');
          common::printIcon('story', 'review',     $vars, $story, 'list', 'search');
          common::printIcon('story', 'close',      $vars, $story, 'list', 'off', '', 'iframe', true);
          common::printIcon('story', 'edit',       $vars, $story, 'list', 'pencil');
          common::printIcon('story', 'createCase', "productID=$story->product&branch=$story->branch&module=0&from=&param=0&$vars", $story, 'list', 'sitemap');
          ?>
        </td>
      </tr>
      <?php endforeach;?>
      </tbody>
      <tfoot>
      <tr>
        <td colspan='11'>
          <div class='table-actions clearfix'>
            <?php if(count($stories)):?>
            <?php echo html::selectButton();?>
            <?php
            $canBatchEdit  = common::hasPriv('story', 'batchEdit');
            $disabled   = $canBatchEdit ? '' : "disabled='disabled'";
            $actionLink = $this->createLink('story', 'batchEdit', "productID=$productID&projectID=0&branch=$branch");
            ?>
            <div class='btn-group dropup'>
              <?php echo html::commonButton($lang->edit, "onclick=\"setFormAction('$actionLink')\" $disabled");?>
              <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>
              <ul class='dropdown-menu'>
                <?php 
                $class = "class='disabled'";

                $canBatchClose = common::hasPriv('story', 'batchClose') && strtolower($browseType) != 'closedbyme' && strtolower($browseType) != 'closedstory';
                $actionLink    = $this->createLink('story', 'batchClose', "productID=$productID&projectID=0");
                $misc = $canBatchClose ? "onclick=\"setFormAction('$actionLink')\"" : $class;
                echo "<li>" . html::a('#', $lang->close, '', $misc) . "</li>";

                if(common::hasPriv('story', 'batchReview'))
                {
                    echo "<li class='dropdown-submenu'>";
                    echo html::a('javascript:;', $lang->story->review, '', "id='reviewItem'");
                    echo "<ul class='dropdown-menu'>";
                    unset($lang->story->reviewResultList['']);
                    unset($lang->story->reviewResultList['revert']);
                    foreach($lang->story->reviewResultList as $key => $result)
                    {
                        $actionLink = $this->createLink('story', 'batchReview', "result=$key");
                        if($key == 'reject')
                        {
                            echo "<li class='dropdown-submenu'>";
                            echo html::a('#', $result, '', "id='rejectItem'");
                            echo "<ul class='dropdown-menu'>";
                            unset($lang->story->reasonList['']);
                            unset($lang->story->reasonList['subdivided']);
                            unset($lang->story->reasonList['duplicate']);

                            foreach($lang->story->reasonList as $key => $reason)
                            {
                                $actionLink = $this->createLink('story', 'batchReview', "result=reject&reason=$key");
                                echo "<li>";
                                echo html::a('#', $reason, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"");
                                echo "</li>";
                            }
                            echo '</ul></li>';
                        }
                        else
                        {
                          echo '<li>' . html::a('#', $result, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"") . '</li>';
                        }
                    }
                    echo '</ul></li>';
                }
                else
                {
                    echo '<li>' . html::a('javascript:;', $lang->story->review,  '', $class) . '</li>';
                }

                if(common::hasPriv('story', 'batchChangeBranch') and $this->session->currentProductType != 'normal')
                {
                    $withSearch = count($branches) > 8;
                    echo "<li class='dropdown-submenu'>";
                    echo html::a('javascript:;', $lang->product->branchName[$this->session->currentProductType], '', "id='branchItem'");
                    echo "<ul class='dropdown-menu" . ($withSearch ? ' with-search':'') . "'>";
                    foreach($branches as $branchID => $branchName)
                    {
                        $actionLink = $this->createLink('story', 'batchChangeBranch', "branchID=$branchID");
                        echo "<li class='option' data-key='$branchID'>" . html::a('#', $branchName, '', "onclick=\"setFormAction('$actionLink', 'hiddenwin')\"") . "</li>";
                    }
                    if($withSearch) echo "<li class='menu-search'><div class='input-group input-group-sm'><input type='text' class='form-control' placeholder=''><span class='input-group-addon'><i class='icon-search'></i></span></div></li>";
                    echo '</ul></li>';
                }

                if(common::hasPriv('story', 'batchChangePlan'))
                {
                    unset($plans['']);
                    $plans      = array(0 => $lang->null) + $plans;
                    $withSearch = count($plans) > 8;
                    echo "<li class='dropdown-submenu'>";
                    echo html::a('javascript:;', $lang->story->planAB, '', "id='planItem'");
                    echo "<ul class='dropdown-menu" . ($withSearch ? ' with-search':'') . "'>";
                    foreach($plans as $planID => $plan)
                    {
                        $actionLink = $this->createLink('story', 'batchChangePlan', "planID=$planID");
                        echo "<li class='option' data-key='$planID'>" . html::a('#', $plan, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"") . "</li>";
                    }
                    if($withSearch) echo "<li class='menu-search'><div class='input-group input-group-sm'><input type='text' class='form-control' placeholder=''><span class='input-group-addon'><i class='icon-search'></i></span></div></li>";
                    echo '</ul></li>';
                }
                else
                {
                    echo '<li>' . html::a('javascript:;', $lang->story->planAB, '', $class) . '</li>';
                }

                if(common::hasPriv('story', 'batchChangeStage'))
                {
                    echo "<li class='dropdown-submenu'>";
                    echo html::a('javascript:;', $lang->story->stageAB, '', "id='stageItem'");
                    echo "<ul class='dropdown-menu'>";
                    $lang->story->stageList[''] = $lang->null;
                    foreach($lang->story->stageList as $key => $stage)
                    {
                        $actionLink = $this->createLink('story', 'batchChangeStage', "stage=$key");
                        echo "<li>" . html::a('#', $stage, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"") . "</li>";
                    }
                    echo '</ul></li>';
                }
                else
                {
                    echo '<li>' . html::a('javascript:;', $lang->story->stageAB, '', $class) . '</li>';
                }

                if(common::hasPriv('story', 'batchAssignTo'))
                {
                      $withSearch = count($users) > 10;
                      $actionLink = $this->createLink('story', 'batchAssignTo', "productID=$productID");
                      echo html::select('assignedTo', $users, '', 'class="hidden"');
                      echo "<li class='dropdown-submenu'>";
                      echo html::a('javascript::', $lang->story->assignedTo, 'id="assignItem"');
                      echo "<ul class='dropdown-menu" . ($withSearch ? ' with-search':'') . "'>";
                      foreach ($users as $key => $value)
                      {
                          if(empty($key)) continue;
                          echo "<li class='option' data-key='$key'>" . html::a("javascript:$(\".table-actions #assignedTo\").val(\"$key\");setFormAction(\"$actionLink\")", $value, '', '') . '</li>';
                      }
                      if($withSearch) echo "<li class='menu-search'><div class='input-group input-group-sm'><input type='text' class='form-control' placeholder=''><span class='input-group-addon'><i class='icon-search'></i></span></div></li>";
                      echo "</ul>";
                      echo "</li>";
                }
                else
                {
                    echo '<li>' . html::a('javascript:;', $lang->story->assignedTo, '', $class) . '</li>';
                }
                ?>
              </ul>
            </div>
            <?php endif; ?>
            <div class='text'><?php echo $summary;?></div>
          </div>
          <?php $pager->show();?>
        </td>
      </tr>
      </tfoot>
    </table>
  </form>
</div>
<script language='javascript'>
$('#module<?php echo $moduleID;?>').addClass('active');
$('#<?php echo $browseType;?>Tab').addClass('active');
</script>
<?php include '../../common/view/footer.html.php';?>

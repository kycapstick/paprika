import css from '../scss/admin.scss';
import ajaxCall from './Components/ajax';

jQuery(document).ready(function($) {
  const handleUpdateCount = function ($button) {
    let action = "update_count";
    const nonce = $button.data('nonce');
    const selector = $button.data('selector');
    const post_id = $button.data('id');
    const count = $(`#${selector}`).val();
    const data = {
      nonce,
      action,
      post_id,
      count,
      selector,
    }
    ajaxCall(data);
  }
  const handleUpdateValue = function($button) {
    let action = "update_value";
    const nonce = $button.data("nonce");
    const selector = $button.data("selector");
    const post_id = $button.data("id");
    const value = $(`#${selector}`).val();
    const data = {
      nonce,
      action,
      post_id,
      value,
      selector
    };
    ajaxCall(data);
  };

  const handleUpdateArray = function($button) {
    let action = "update_array";
    const nonce = $button.data("nonce");
    const selector = $button.data("selector");
    const post_id = $button.data("id");
    const $choices = $(`.${selector}`);
    const type = $button.data("type");
    const count_selector = $button.data('count_selector');
    const count = $(`#${count_selector}`).val();
    const value = [];
    $choices.each(function(i, item) {
      if (item) {
        value.push($(item).val());
      }
    });
    const data = {
      nonce,
      action,
      post_id,
      value,
      selector,
      type,
      count,
    };
    ajaxCall(data);
  }

  const populateTimeSlot = function(index, item) {
    const $item = $(item);
    const timeSlot = {}
    let name = $item.find(`#timeSlot${index}Name`);
    let showCount = $item.find(`#timeSlot${index}ShowCount`);
    let allShows = $item.find('.shows');
    const shows = [];
    if (allShows.length > 0) {
      allShows.each((i, show) => {
        let value = $(show).val();
        shows.push(value);
      });
      timeSlot['shows'] = shows;
    }
    timeSlot['showCount'] = $(showCount).val();
    timeSlot['name'] = $(name).val();
    return timeSlot;
  }

  const handleUpdateTimeSlotArray = function($button) {
    let action = "update_array";
    const type = $button.data("type");
    const nonce = $button.data("nonce");
    const selector = $button.data("selector");
    const count_selector = $button.data("count_selector");
    const count = $(`#${count_selector}`).val();
    const post_id = $button.data("id");
    const $choices = $(`.${selector}`);
    const value = [];
    $choices.each(function(i, item) {
      if (item) {
        const timeSlot = populateTimeSlot(i, item);
        value.push(timeSlot);
      }
    });
    const data = {
      nonce,
      action,
      post_id,
      value,
      selector,
      type,
      count
    };
    ajaxCall(data);
  };

  // UPDATE VALUES

  $("#update-festival").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateValue($this);
  });

  $("#update-role").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateValue($this);
  });

  $("#update-title").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateValue($this);
  });

  // UPDATE COUNTS

  $('#update-artist-count').click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateCount($this);
  })

  $("#update-mentor-count").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateCount($this);
  });

  $("#update-date-count").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateCount($this);
  });

  $("#update-timeslot-count").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateCount($this);
  });

  // UPDATE ARRAYS

  $("#update-artists-array").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateArray($this);
  });

  $("#update-mentors-array").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateArray($this);
  });

  // TimeSlot Array
  $("#update-timeslot-array").click(function(e) {
    e.preventDefault();
    const $this = $(this);
    handleUpdateTimeSlotArray($this);
  });    
});
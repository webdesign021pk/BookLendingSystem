<?php
class Reset_demo extends CI_Model {
    public function reset()
    {
        $this->db->truncate('lm_tbl_books');
        $this->db->truncate('lm_tbl_category');
        $this->db->truncate('lm_tbl_checkout');
        $this->db->truncate('lm_tbl_finance');
        $this->db->truncate('lm_tbl_language');
        $this->db->truncate('lm_tbl_members');
        echo"Cleared tables <br />";
        $q = "INSERT INTO `lm_tbl_books` (`bookIdPK`, `title`, `author`, `languageId`, `publisher`, `subCatId`, `bookStatus`, `cost`, `notes`, `memberIdPK`, `created_at`) VALUES
                (1, 'A Matter Of Honour', 'Jeffrey Archer', 1, 'Jeffrey Archer', 87, 2, 150, '', 2, '2020-01-27 20:31:59'),
                (2, 'A Prison Diary', 'Jeffrey Archer', 1, 'Jeffrey Archer', 87, 1, 250, '', 1, '2020-01-27 20:35:46'),
                (3, 'A Thousand Splendid Sun', 'Khaled Hosseini', 1, 'Mics', 87, 1, 250, '', 0, '2020-01-27 20:37:13'),
                (4, 'Brida', 'Paulo Coelho', 1, 'Paulo Coelho', 87, 0, 120, '', 2, '2020-01-27 21:19:59'),
                (5, 'Amazing Science', 'Parveen Arif Ali', 1, 'Parveen Arif Ali', 42, 1, 150, '', 3, '2020-01-28 13:52:26'),
                (6, 'Arabic To Urdu Dictionary', 'Qazi Zainulabdin', 5, 'Qazi Zainulabdin', 39, 1, 200, '', 3, '2020-01-28 13:53:20'),
                (7, 'Business Information System ', 'Kenneth C Landon', 1, 'Kenneth C Landon ', 57, 1, 170, '', 4, '2020-01-28 13:54:56'),
                (8, 'Chambers Young Set Dictionary', 'Amy L Brown', 1, 'Amy L Brown', 39, 1, 150, '', 5, '2020-01-28 13:55:46'),
                (9, 'Aptitute Test', 'Muhammad Sheraz', 1, 'Muhammad Sheraz', 88, 1, 120, '', 5, '2020-01-28 13:59:15'),
                (10, 'Chemistry A Course For O Level', 'Christopher N Prescott', 1, 'Christopher N Prescott', 90, 1, 329, '', 0, '2020-01-28 14:02:19'),
                (11, 'Gce O Level Islamiyat', 'Redspot', 1, 'Redspot', 94, 1, 150, '', 0, '2020-01-28 14:03:11'),
                (12, 'Intelligence And Psychological Test', 'Muhammad Iqbal Tabish', 1, 'Muhammad Iqbal Tabish', 22, 1, 120, '', 0, '2020-01-28 14:06:23'),
                (13, 'Shapes And Colors', 'Genny Haines', 1, 'Genny Haines', 69, 1, 120, '', 0, '2020-01-28 14:07:14'),
                (14, 'Sky Dancers Skylas Wish', 'Lady Bird', 1, 'Lady Bird', 69, 1, 120, '', 0, '2020-01-28 14:08:30'),
                (15, 'Secret Seven', 'Enid Blyton', 1, 'Enid Blyton', 69, 1, 150, '', 0, '2020-01-28 14:09:52'),
                (16, 'Sheriff Showoff', 'Clive Gifford', 1, 'Clive Gifford', 69, 0, 150, '', 0, '2020-01-28 14:10:43');";
        $q2 = "INSERT INTO `lm_tbl_category` (`subCatIdPK`, `category`, `subCat`, `isParent`, `parentId`) VALUES
                (1, 'Computer science', 'General', 0, 0),
                (2, 'Computer science', 'Operating Systems', 0, 0),
                (3, 'Computer science', 'Data processing', 0, 0),
                (4, 'Computer science', 'Programming Languages ', 0, 0),
                (5, 'Computer science', 'Application Software', 0, 0),
                (6, 'Philosophy and psychology', 'Philosophy', 0, 0),
                (7, 'Philosophy and psychology', 'Organizations and management', 0, 0),
                (8, 'Philosophy and psychology', 'Metaphysics', 0, 0),
                (9, 'Philosophy and psychology', 'Psychology', 0, 0),
                (10, 'Philosophy and psychology', 'Differential and developmental psychology', 0, 0),
                (11, 'Philosophy and psychology', 'Applied psychology', 0, 0),
                (12, 'Philosophy and psychology', 'Ethics and Ethical systems', 0, 0),
                (13, 'Philosophy and psychology', 'Political ethics', 0, 0),
                (14, 'Philosophy and psychology', 'Ethics of family relationships', 0, 0),
                (15, 'Philosophy and psychology', 'Occupational ethics', 0, 0),
                (16, 'Philosophy and psychology', 'Ethics of social relations', 0, 0),
                (17, 'Philosophy and psychology', 'Other ethical norms', 0, 0),
                (18, 'Philosophy and psychology', 'Ancient, medieval, eastern philosophy', 0, 0),
                (19, 'Philosophy and psychology', 'Eastern philosophy', 0, 0),
                (20, 'Philosophy and psychology', 'Medieval Western philosophy', 0, 0),
                (21, 'Philosophy and psychology', 'Modern Western and other non eastern philosophy', 0, 0),
                (22, 'Philosophy and psychology', 'General', 0, 0),
                (23, 'Religion', 'General', 0, 0),
                (24, 'Religion', 'Philosophy and theory of religion', 0, 0),
                (25, 'Religion', 'Non Islamic Religions', 0, 0),
                (26, 'Social sciences', 'General', 0, 0),
                (27, 'Social sciences', 'Sociology and anthropology', 0, 0),
                (28, 'Social sciences', 'Culture and Institutions', 0, 0),
                (29, 'Social sciences', 'Communities', 0, 0),
                (30, 'Social sciences', 'Politics and Government', 0, 0),
                (31, 'Social sciences', 'Economics, Socialism & related systems', 0, 0),
                (32, 'Social sciences', 'Constitutional and Administrative law', 0, 0),
                (33, 'Social sciences', 'Labor, social service, education, cultural law', 0, 0),
                (34, 'Social sciences', 'Public administration', 0, 0),
                (35, 'Social sciences', 'Education', 0, 0),
                (36, 'Social sciences', 'Schools and their activities, special education', 0, 0),
                (37, 'Language', 'General', 0, 0),
                (38, 'Language', 'Linguistics', 0, 0),
                (39, 'Language', 'Dictionaries', 0, 0),
                (40, 'Language', 'Grammar of standard forms of languages', 0, 0),
                (41, 'Language', 'Sign languages', 0, 0),
                (42, 'Science', 'General', 0, 0),
                (43, 'Science', 'Mathematics', 0, 0),
                (44, 'Science', 'Astronomy and allied sciences', 0, 0),
                (45, 'Science', 'Chemistry and allied sciences', 0, 0),
                (46, 'Science', 'Physics and allied sciences', 0, 0),
                (47, 'Science', 'Earth sciences and geology', 0, 0),
                (48, 'Science', 'Biology, Physiology and related subjects', 0, 0),
                (49, 'Science', ' Genetics, Ecology and evolution', 0, 0),
                (50, 'Science', 'Plants and related studies', 0, 0),
                (51, 'Science', 'Animal kingdom and related studies', 0, 0),
                (52, 'Technology', 'General', 0, 0),
                (53, 'Technology', 'Medicine and health', 0, 0),
                (54, 'Technology', 'Engineering and Applied operations', 0, 0),
                (55, 'Technology', 'Agriculture and related technologies', 0, 0),
                (56, 'Technology', 'Home and family management', 0, 0),
                (57, 'Technology', 'Management and auxiliary services', 0, 0),
                (58, 'Technology', 'Chemical engineering and related technologies', 0, 0),
                (59, 'Technology', 'Manufacturing', 0, 0),
                (60, 'Arts and recreation', 'Arts and General', 0, 0),
                (61, 'Arts and recreation', 'Area planning and landscape architecture', 0, 0),
                (62, 'Arts and recreation', 'Sculpture, ceramics, and metalwork', 0, 0),
                (63, 'Arts and recreation', 'Graphic arts and decorative arts', 0, 0),
                (64, 'Arts and recreation', 'Painting and Printing', 0, 0),
                (65, 'Arts and recreation', 'Photography, computer art, cinematography, videogr', 0, 0),
                (66, 'Arts and recreation', 'Music and allied fields', 0, 0),
                (67, 'Arts and recreation', 'Recreational and performing arts', 0, 0),
                (68, 'Literature', 'General', 0, 0),
                (69, 'Literature', 'Fiction', 0, 0),
                (70, 'Literature', 'Poetry', 0, 0),
                (71, 'Literature', 'Essays', 0, 0),
                (72, 'Literature', 'Speeches', 0, 0),
                (73, 'Literature', 'Drama', 0, 0),
                (74, 'Literature', 'Humor and satire', 0, 0),
                (75, 'Literature', 'Miscellaneous writings', 0, 0),
                (76, 'History and geography', 'History, geography, and auxiliary disciplines', 0, 0),
                (77, 'History and geography', 'Dictionaries, encyclopedias, concordances of history', 0, 0),
                (78, 'History and geography', 'Geography and travel', 0, 0),
                (79, 'History and geography', 'Historical geography', 0, 0),
                (80, 'History and geography', 'History of Europe', 0, 0),
                (81, 'History and geography', 'Ancient History', 0, 0),
                (82, 'History and geography', 'History of Asia', 0, 0),
                (83, 'History and geography', 'History of Africa', 0, 0),
                (84, 'History and geography', 'History of North America', 0, 0),
                (85, 'History and geography', 'History of South America', 0, 0),
                (86, 'History and geography', 'History of Australia and neighboring countries', 0, 0),
                (87, 'Literature', 'Novels', 0, 0),
                (88, 'Education and Curriculum', 'General', 0, 0),
                (89, 'Education and Curriculum', 'Physics', 0, 0),
                (90, 'Education and Curriculum', 'Chemistry', 0, 0),
                (91, 'Education and Curriculum', 'Mathematics', 0, 0),
                (92, 'Education and Curriculum', 'Language', 0, 0),
                (93, 'Education and Curriculum', 'Computers and IT', 0, 0),
                (94, 'Education and Curriculum', 'Religious', 0, 0),
                (95, 'Education and Curriculum', 'Biology', 0, 0);";
        $q3 = "INSERT INTO `lm_tbl_checkout` (`checkOutIdPK`, `memberId`, `bookId`, `dueDate`, `returnDate`, `fine`, `isPaid`, `created_at`) VALUES
                (1, 1, 4, '2020-02-04', '2020-01-28', 0, 1, '2020-01-28 16:20:01'),
                (2, 3, 5, '2020-01-29', '2020-01-28', 0, 1, '2020-01-28 16:21:05'),
                (3, 2, 1, '2020-01-29', '2020-01-30', 1, 1, '2020-01-29 13:41:52'),
                (4, 2, 3, '2020-01-28', '2020-01-29', 1, 1, '2020-01-29 13:42:09'),
                (5, 1, 2, '2020-02-05', '2020-02-06', 1, 1, '2020-01-29 13:56:42'),
                (6, 4, 6, '2020-01-31', '2020-02-10', 10, 10, '2020-01-30 14:37:13'),
                (7, 6, 9, '2020-01-31', '2020-02-10', 10, 10, '2020-01-30 14:37:30'),
                (8, 3, 8, '2020-02-02', '2020-02-09', 7, 7, '2020-01-30 14:37:54'),
                (9, 2, 11, '2020-02-06', '2020-02-10', 4, 4, '2020-01-30 14:55:39'),
                (10, 2, 12, '2020-02-06', '2020-02-10', 4, 4, '2020-01-30 14:57:16'),
                (11, 5, 10, '2020-02-01', '2020-02-02', 1, 1, '2020-02-01 01:07:47'),
                (12, 5, 1, '2020-02-01', '2020-02-02', 1, 1, '2020-02-01 01:09:07'),
                (13, 1, 2, '2020-02-15', '2020-02-09', 0, 0, '2020-02-08 09:02:50'),
                (14, 1, 10, '2020-02-10', '2020-02-09', 0, 0, '2020-02-09 12:09:46'),
                (15, 1, 1, '2020-02-16', '2020-02-09', 0, 0, '2020-02-09 12:12:01'),
                (16, 1, 3, '2020-02-16', '2020-02-10', 0, 0, '2020-02-09 12:12:26'),
                (17, 3, 1, '2020-02-16', '2020-02-10', 0, 0, '2020-02-09 12:58:19'),
                (18, 3, 2, '2020-02-16', '2020-02-10', 0, 0, '2020-02-09 12:58:19'),
                (19, 3, 2, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:25:22'),
                (20, 3, 5, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:28:43'),
                (21, 3, 6, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:30:22'),
                (22, 3, 6, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:32:17'),
                (23, 3, 7, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:32:17'),
                (24, 3, 8, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:32:48'),
                (25, 3, 9, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:32:49'),
                (26, 3, 6, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:35:27'),
                (27, 3, 7, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:35:27'),
                (28, 3, 6, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:45:04'),
                (29, 3, 4, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:45:04'),
                (30, 3, 6, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:51:25'),
                (31, 3, 7, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:51:25'),
                (32, 3, 6, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:53:14'),
                (33, 1, 1, '2020-02-09', '2020-02-10', 1, 1, '2020-02-11 00:56:08'),
                (34, 1, 1, '2020-02-10', '2020-02-11', 1, 1, '2020-02-11 12:54:27'),
                (35, 1, 2, '2020-02-10', '2020-02-11', 1, 1, '2020-02-11 13:10:52'),
                (36, 1, 2, '2020-02-10', '2020-02-11', 1, 1, '2020-02-11 13:12:19'),
                (37, 1, 9, '2020-02-21', '2020-02-14', 0, 0, '2020-02-14 13:30:21'),
                (38, 2, 1, '2020-02-22', '2020-02-15', 0, 0, '2020-02-15 23:13:05'),
                (39, 2, 4, '2020-02-22', '2020-02-15', 0, 0, '2020-02-15 23:13:05'),
                (40, 2, 1, '2020-02-14', '2020-02-15', 1, 1, '2020-02-15 23:20:49'),
                (41, 7, 9, '2020-02-22', '2020-02-16', 0, 0, '2020-02-15 23:22:26'),
                (42, 1, 4, '2020-02-19', '2020-02-15', 0, 0, '2020-02-15 23:24:25'),
                (43, 1, 2, '2020-02-13', '2020-02-15', 2, 2, '2020-02-15 23:24:38'),
                (44, 7, 2, '2020-02-15', '2020-02-16', 1, 1, '2020-02-16 12:21:03'),
                (45, 1, 2, '2020-02-15', '2020-02-16', 1, 1, '2020-02-16 13:41:10'),
                (46, 1, 1, '2020-02-15', '2020-02-16', 1, 0, '2020-02-16 13:42:38'),
                (47, 1, 2, '2020-02-23', '', 0, 0, '2020-02-16 13:43:11'),
                (48, 2, 1, '2020-02-23', '', 0, 0, '2020-02-16 20:53:18'),
                (49, 2, 4, '2020-02-15', '', 0, 0, '2020-02-16 20:53:31'),
                (50, 3, 5, '2020-02-15', '', 0, 0, '2020-02-16 20:53:54'),
                (51, 3, 6, '2020-02-15', '', 0, 0, '2020-02-16 20:53:54'),
                (52, 4, 7, '2020-02-23', '', 0, 0, '2020-02-16 20:54:06'),
                (53, 5, 8, '2020-02-14', '', 0, 0, '2020-02-16 20:54:52'),
                (54, 5, 9, '2020-02-12', '', 0, 0, '2020-02-16 20:54:52');";
        $q4 = "INSERT INTO `lm_tbl_finance` (`financeIdPK`, `memberId`, `paymentType`, `amount`, `dateCreated`, `notes`) VALUES
                (1, 1, 1, 1, '2020-02-10', ''),
                (2, 1, 1, 1, '2020-02-10', ''),
                (3, 1, 1, 1, '2020-02-10', ''),
                (4, 2, 1, 1, '2020-02-10', ''),
                (5, 5, 1, 1, '2020-02-10', ''),
                (6, 5, 1, 1, '2020-02-10', ''),
                (7, 5, 1, 1, '2020-02-10', ''),
                (8, 5, 1, 1, '2020-02-10', ''),
                (9, 5, 1, 1, '2020-02-10', ''),
                (10, 5, 1, 1, '2020-02-10', ''),
                (11, 5, 1, 1, '2020-02-10', ''),
                (12, 5, 1, 1, '2020-02-10', ''),
                (13, 2, 1, 1, '2020-02-10', ''),
                (14, 2, 1, 4, '2020-02-10', ''),
                (15, 2, 1, 4, '2020-02-10', ''),
                (16, 3, 1, 7, '2020-02-10', ''),
                (17, 3, 1, 1, '2020-02-10', ''),
                (18, 3, 1, 1, '2020-02-10', ''),
                (19, 3, 1, 1, '2020-02-10', ''),
                (20, 3, 1, 1, '2020-02-10', ''),
                (21, 3, 1, 1, '2020-02-10', ''),
                (22, 3, 1, 1, '2020-02-10', ''),
                (23, 3, 1, 1, '2020-02-10', ''),
                (24, 3, 1, 1, '2020-02-10', ''),
                (25, 3, 1, 1, '2020-02-10', ''),
                (26, 3, 1, 1, '2020-02-10', ''),
                (27, 3, 1, 1, '2020-02-10', ''),
                (28, 3, 1, 1, '2020-02-10', ''),
                (29, 3, 1, 1, '2020-02-10', ''),
                (30, 3, 1, 1, '2020-02-10', ''),
                (31, 4, 1, 10, '2020-02-10', ''),
                (32, 6, 1, 10, '2020-02-10', ''),
                (33, 1, 1, 1, '2020-02-10', ''),
                (34, 1, 1, 1, '2020-02-11', ''),
                (35, 1, 1, 1, '2020-02-11', ''),
                (36, 1, 1, 1, '2020-02-11', ''),
                (37, 2, 2, 20, '2020-02-12', ''),
                (38, 3, 2, 50, '2020-02-12', ''),
                (39, 6, 2, 30, '2020-02-14', ''),
                (40, 7, 2, 20, '2020-02-15', ''),
                (41, 7, 2, 20, '2020-02-15', ''),
                (42, 7, 2, 20, '2020-02-15', ''),
                (43, 7, 2, 20, '2020-02-15', ''),
                (44, 7, 2, 20, '2020-02-15', ''),
                (45, 7, 2, 20, '2020-02-15', ''),
                (46, 7, 2, 30, '2020-02-15', ''),
                (47, 7, 2, 10, '2020-02-15', ''),
                (48, 7, 2, 10, '2020-02-15', ''),
                (49, 7, 2, 10, '2020-02-15', ''),
                (50, 7, 2, 20, '2020-02-15', ''),
                (51, 7, 2, 30, '2020-02-15', ''),
                (52, 2, 1, 1, '2020-02-15', ''),
                (53, 1, 1, 2, '2020-02-15', ''),
                (54, 7, 1, 1, '2020-02-16', ''),
                (55, 1, 1, 1, '2020-02-16', ''),
                (56, 1, 2, 20, '2020-02-16', '');";
        $q5 = "INSERT INTO `lm_tbl_language` (`languageIdPK`, `language`) VALUES
                (1, 'English-UK'),
                (2, 'Urdu'),
                (3, 'Sindhi'),
                (4, 'French'),
                (5, 'Arabic'),
                (6, 'spanish'),
                (7, 'German'),
                (8, 'Persian'),
                (9, 'Russian'),
                (10, 'EnglishUS');";
        $q6 = "INSERT INTO `lm_tbl_members` (`memberIdPK`, `fullName`, `contact`, `address`, `dob`, `cnic`, `gender`, `memberStatus`, `booksAllowed`, `initialDate`, `expiry`, `image_path`, `modifiedBy`, `created_at`) VALUES
                (1, 'Francoise Rautenstrauch', '5195698399', '2335 Canton Hwy 6', '2019-12-29', '5195698399', 2, 1, 1, '2020-02-16', '2020-04-16', 'uploads/5195698399.jpg', 0, '2020-01-26 15:47:28'),
                (2, 'Kendra Loud', '5063631526', '6 Arch St No 9757', '2019-12-30', '5063631526', 1, 1, 2, '2020-02-12', '2020-01-12', 'uploads/5063631526.jpg', 0, '2020-01-26 15:53:52'),
                (3, 'Lourdes Bauswell', '6139037043', '9547 Belmont Rd 21', '2019-12-31', '6139037043', 1, 1, 2, '2020-02-12', '2019-07-12', 'uploads/6139037043.jpg', 0, '2020-01-26 15:57:12'),
                (4, 'Hannah Edmison', '6043343686', '73 Pittsford Victor Rd', '2020-01-01', '6043343686', 2, 0, 1, '2020-01-26', '2020-01-26', 'uploads/6043343686.jpg', 0, '2020-01-26 15:58:10'),
                (5, 'Queenie Kramarczyk', '3064215793', '47 Garfield Ave', '2020-01-02', '3064215793', 2, 2, 3, '2020-01-26', '2019-12-26', 'uploads/3064215793.jpg', 0, '2020-01-26 15:59:24'),
                (6, 'Hui Portaro', '5068277755', '3 Mill Rd', '2020-01-04', '5068277755', 2, 1, 1, '2020-02-14', '2020-01-14', 'uploads/5068277755.jpg', 0, '2020-01-26 16:00:24');";
        $this->db->query($q);
        echo $this->db->affected_rows().'<br />';
        $this->db->query($q2);
        echo $this->db->affected_rows().'<br />';
        $this->db->query($q3);
        echo $this->db->affected_rows().'<br />';
        $this->db->query($q4);
        echo $this->db->affected_rows().'<br />';
        $this->db->query($q5);
        echo $this->db->affected_rows().'<br />';
        $this->db->query($q6);
        echo $this->db->affected_rows().'<br />';

        //deleting files
        $files = glob($_SERVER['DOCUMENT_ROOT'].'/LMS/uploads/*'); // get all file names
        foreach($files as $file)
        { // iterate files
            if(is_file($file))
                unlink($file); // delete file
            echo $file.' deleted';
        }

        //copying files
        //preparing the paths
        $dstdir=$_SERVER['DOCUMENT_ROOT']."/LMS/uploads";
        $srcdir=$_SERVER['DOCUMENT_ROOT']."/LMS/uploads2";
        $srcdir=rtrim($srcdir,'/');
        $dstdir=rtrim($dstdir,'/');

        //creating the destination directory
        if(!is_dir($dstdir))mkdir($dstdir, 0777, true);

        //Mapping the directory
        $dir_map=directory_map($srcdir);

        foreach($dir_map as $object_key=>$object_value)
        {
                if(is_numeric($object_key))
                      echo copy($srcdir.'/'.$object_value,$dstdir.'/'.$object_value);//This is a File not a directory
                      echo "<br />";

                /*else*/
                        //directory_copy($srcdir.'/'.$object_key,$dstdir.'/'.$object_key);//this is a directory
        }
        //End Copy Files
    }

}
# Conway's Game of Life in PHP
Conway's Game of Life implementation in PHP. Uses a sparse matrix to keep a list of alive cells. Read more about the game of life at [Wikipedia](https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life).

### Example Oscillator
```bash
% php app.php 3
Initial State:
00000
0###0
00000
00000
00000
--
Step 1:
00#00
00#00
00#00
00000
00000
--
Step 2:
00000
0###0
00000
00000
00000
--
Step 3:
00#00
00#00
00#00
00000
00000
```
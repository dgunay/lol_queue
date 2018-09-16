# LoL Queue

The idea is to create a virtual queue of thousands of fake players, and match
them up to make league games the way League of Legends would, by role.

## Goals

I am thinking some kind of interface should be made so that I can benchmark
several different algorithms and supporting technologies/backends. For example,
is a DB useful here? Do it all in memory? etc.

Hopefully I'll learn something cool, it sounded like a nice fun little oneoff.

## Architecture

So what I have hacked together is like so:

It starts with Players. A Player is basically just their elo. Their elo can be
incremented/decremented. I plan on adding roles at some point.

A Team can be made up of five players. A Team can tell you what its average elo
is. At some point I will have it be composed of certain roles.

You've got a Queue. A Queue collects Players while they wait to be put into
Teams. When Teams are created, they are pitted against each other in matches.

In determining how to compose Teams and how to match Teams against each other,
the Queue may impose TeamCriteria and MatchCriteria. These are interfaces - any
implementation of them can qualify or disqualify a team composition/matchup 
however it wants. At this time, criteria are negative in nature, not positive.
At some point I would like to have both negative and positive criteria. 

